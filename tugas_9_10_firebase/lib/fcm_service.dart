import 'package:firebase_core/firebase_core.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';

// ─── Background handler (harus top-level function) ───────────────────────────
@pragma('vm:entry-point')
Future<void> firebaseMessagingBackgroundHandler(RemoteMessage message) async {
  await Firebase.initializeApp();
  // Notifikasi background ditampilkan otomatis oleh sistem Android
  print('📩 Background message: ${message.messageId}');
}

// ─── FCM Service ─────────────────────────────────────────────────────────────
class FcmService {
  static final FlutterLocalNotificationsPlugin _localNotif =
      FlutterLocalNotificationsPlugin();

  // Channel untuk Android
  static const AndroidNotificationChannel _channel = AndroidNotificationChannel(
    'high_importance_channel',
    'High Importance Notifications',
    description: 'Channel untuk notifikasi FCM',
    importance: Importance.high,
  );

  // Inisialisasi: dipanggil sekali di main()
  static Future<void> initialize() async {
    // Setup local notifications (untuk tampilkan notif saat foreground)
    const AndroidInitializationSettings androidSettings =
        AndroidInitializationSettings('@mipmap/ic_launcher');
    const InitializationSettings initSettings =
        InitializationSettings(android: androidSettings);
    await _localNotif.initialize(initSettings);

    // Buat notification channel di Android
    await _localNotif
        .resolvePlatformSpecificImplementation<
            AndroidFlutterLocalNotificationsPlugin>()
        ?.createNotificationChannel(_channel);
  }

  // Minta izin notifikasi & ambil FCM token
  static Future<String?> requestPermissionAndGetToken() async {
    final messaging = FirebaseMessaging.instance;

    final settings = await messaging.requestPermission(
      alert: true,
      badge: true,
      sound: true,
    );

    if (settings.authorizationStatus == AuthorizationStatus.authorized) {
      print('✅ Izin notifikasi diberikan');
    } else {
      print('❌ Izin notifikasi ditolak');
    }

    final token = await messaging.getToken();
    print('🔑 FCM Token: $token');
    return token;
  }

  // Tampilkan notifikasi lokal saat aplikasi di foreground
  static void showLocalNotification(RemoteMessage message) {
    final notification = message.notification;
    final android = message.notification?.android;
    if (notification == null) return;

    _localNotif.show(
      notification.hashCode,
      notification.title,
      notification.body,
      NotificationDetails(
        android: AndroidNotificationDetails(
          _channel.id,
          _channel.name,
          channelDescription: _channel.description,
          icon: android?.smallIcon ?? '@mipmap/ic_launcher',
          importance: Importance.high,
          priority: Priority.high,
        ),
      ),
    );
  }
}
