import 'package:firebase_core/firebase_core.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import 'fcm_service.dart';
import 'home_page.dart';
import 'todo_provider.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();

  // 1. Inisialisasi Firebase (membaca google-services.json otomatis)
  await Firebase.initializeApp();

  // 2. Daftarkan background message handler (harus sebelum runApp)
  FirebaseMessaging.onBackgroundMessage(firebaseMessagingBackgroundHandler);

  // 3. Setup local notifications (untuk tampilkan notif saat foreground)
  await FcmService.initialize();

  runApp(
    // 4. Multi-provider di root agar semua widget bisa akses state
    MultiProvider(
      providers: [
        ChangeNotifierProvider(create: (_) => TodoProvider()),
        ChangeNotifierProvider(create: (_) => FcmTokenProvider()),
      ],
      child: const MyApp(),
    ),
  );
}

class MyApp extends StatefulWidget {
  const MyApp({super.key});

  @override
  State<MyApp> createState() => _MyAppState();
}

class _MyAppState extends State<MyApp> {
  @override
  void initState() {
    super.initState();
    _initFcm();
  }

  Future<void> _initFcm() async {
    // Minta izin & ambil FCM token
    final token = await FcmService.requestPermissionAndGetToken();

    if (!mounted) return;

    // Simpan token ke FcmTokenProvider
    context.read<FcmTokenProvider>().setToken(token);

    // ── Listener: Notifikasi saat app di FOREGROUND ──
    FirebaseMessaging.onMessage.listen((RemoteMessage message) {
      if (!mounted) return;

      // Tampilkan sebagai popup local notification
      FcmService.showLocalNotification(message);

      // Jika pesan punya data 'add_task', tambahkan ke todo list
      final data = message.data;
      if (data.containsKey('add_task')) {
        context.read<TodoProvider>().addTodoFromNotification(
              data['add_task'] as String,
            );
      }

      // Tampilkan SnackBar
      final notif = message.notification;
      if (notif != null) {
        final scaffoldCtx = _scaffoldKey.currentContext;
        if (scaffoldCtx != null) {
          ScaffoldMessenger.of(scaffoldCtx).showSnackBar(
            SnackBar(
              content: Row(
                children: [
                  const Icon(Icons.notifications_rounded,
                      color: Colors.white, size: 18),
                  const SizedBox(width: 8),
                  Expanded(
                    child: Text(
                      '${notif.title ?? ''}: ${notif.body ?? ''}',
                      maxLines: 2,
                      overflow: TextOverflow.ellipsis,
                    ),
                  ),
                ],
              ),
              backgroundColor: Colors.indigo,
              duration: const Duration(seconds: 4),
              behavior: SnackBarBehavior.floating,
            ),
          );
        }
      }
    });

    // ── Listener: Notifikasi saat app di BACKGROUND (tap notif → buka app) ──
    FirebaseMessaging.onMessageOpenedApp.listen((RemoteMessage message) {
      final data = message.data;
      if (data.containsKey('add_task') && mounted) {
        context.read<TodoProvider>().addTodoFromNotification(
              data['add_task'] as String,
            );
      }
    });

    // Cek apakah app dibuka dari terminated state via notifikasi
    final initial = await FirebaseMessaging.instance.getInitialMessage();
    if (initial != null && initial.data.containsKey('add_task') && mounted) {
      context.read<TodoProvider>().addTodoFromNotification(
            initial.data['add_task'] as String,
          );
    }
  }

  final GlobalKey<ScaffoldMessengerState> _scaffoldKey =
      GlobalKey<ScaffoldMessengerState>();

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Todo + FCM',
      debugShowCheckedModeBanner: false,
      scaffoldMessengerKey: _scaffoldKey,
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.indigo),
        useMaterial3: true,
      ),
      home: const HomePage(),
    );
  }
}
