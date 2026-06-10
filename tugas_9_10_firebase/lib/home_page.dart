import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:provider/provider.dart';
import 'todo_provider.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  final TextEditingController _controller = TextEditingController();

  @override
  void dispose() {
    _controller.dispose();
    super.dispose();
  }

  // Dialog konfirmasi hapus semua
  void _confirmClearAll(BuildContext context) {
    showDialog(
      context: context,
      builder: (ctx) => AlertDialog(
        title: const Text('Hapus Semua Tugas?'),
        content: const Text(
            'Semua tugas akan dihapus permanen. Yakin ingin melanjutkan?'),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(ctx),
            child: const Text('Batal'),
          ),
          FilledButton(
            style: FilledButton.styleFrom(backgroundColor: Colors.red),
            onPressed: () {
              context.read<TodoProvider>().clearAllTodos();
              Navigator.pop(ctx);
              ScaffoldMessenger.of(context).showSnackBar(
                const SnackBar(
                  content: Text('Semua tugas telah dihapus'),
                  backgroundColor: Colors.red,
                ),
              );
            },
            child: const Text('Hapus Semua'),
          ),
        ],
      ),
    );
  }

  // Tambah tugas dari input field
  void _addTodo(BuildContext context) {
    final text = _controller.text.trim();
    if (text.isEmpty) return;
    context.read<TodoProvider>().addTodo(text);
    _controller.clear();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF5F6FA),
      appBar: AppBar(
        backgroundColor: Colors.indigo,
        foregroundColor: Colors.white,
        title: const Text(
          '📋 To-Do List',
          style: TextStyle(fontWeight: FontWeight.bold),
        ),
        actions: [
          // Tombol hapus semua
          Consumer<TodoProvider>(
            builder: (_, provider, __) => provider.todos.isEmpty
                ? const SizedBox()
                : IconButton(
                    icon: const Icon(Icons.delete_sweep_rounded),
                    tooltip: 'Hapus Semua',
                    onPressed: () => _confirmClearAll(context),
                  ),
          ),
        ],
      ),
      body: Column(
        children: [
          // ── Header statistik ──
          Consumer<TodoProvider>(
            builder: (_, provider, __) => Container(
              width: double.infinity,
              padding:
                  const EdgeInsets.symmetric(vertical: 12, horizontal: 16),
              color: Colors.indigo.shade50,
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Text(
                    'Total tugas: ${provider.todos.length}',
                    style: const TextStyle(
                        color: Colors.indigo, fontWeight: FontWeight.w500),
                  ),
                  Text(
                    'Selesai: ${provider.doneCount}/${provider.todos.length}',
                    style: TextStyle(
                        color: Colors.green.shade700,
                        fontWeight: FontWeight.w500),
                  ),
                ],
              ),
            ),
          ),

          // ── Input tambah tugas ──
          Padding(
            padding:
                const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
            child: Row(
              children: [
                Expanded(
                  child: TextField(
                    controller: _controller,
                    decoration: InputDecoration(
                      hintText: 'Tambah tugas baru...',
                      filled: true,
                      fillColor: Colors.white,
                      prefixIcon: const Icon(Icons.edit_note_rounded,
                          color: Colors.indigo),
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(12),
                        borderSide: BorderSide.none,
                      ),
                      contentPadding: const EdgeInsets.symmetric(
                          horizontal: 12, vertical: 14),
                    ),
                    onSubmitted: (_) => _addTodo(context),
                    textInputAction: TextInputAction.done,
                  ),
                ),
                const SizedBox(width: 8),
                FilledButton(
                  style: FilledButton.styleFrom(
                    backgroundColor: Colors.indigo,
                    shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12)),
                    padding: const EdgeInsets.symmetric(
                        horizontal: 16, vertical: 14),
                  ),
                  onPressed: () => _addTodo(context),
                  child: const Icon(Icons.add_rounded, color: Colors.white),
                ),
              ],
            ),
          ),

          // ── Daftar tugas ──
          Expanded(
            child: Consumer<TodoProvider>(
              builder: (_, provider, __) {
                if (provider.todos.isEmpty) {
                  return const Center(
                    child: Column(
                      mainAxisSize: MainAxisSize.min,
                      children: [
                        Icon(Icons.checklist_rounded,
                            size: 72, color: Colors.grey),
                        SizedBox(height: 12),
                        Text(
                          'Belum ada tugas.\nTambahkan tugas di atas!',
                          textAlign: TextAlign.center,
                          style: TextStyle(color: Colors.grey, fontSize: 15),
                        ),
                      ],
                    ),
                  );
                }

                return ListView.separated(
                  padding: const EdgeInsets.fromLTRB(16, 0, 16, 24),
                  itemCount: provider.todos.length,
                  separatorBuilder: (_, __) => const SizedBox(height: 8),
                  itemBuilder: (ctx, index) {
                    final todo = provider.todos[index];
                    return Dismissible(
                      key: Key(todo.id),
                      direction: DismissDirection.endToStart,
                      background: Container(
                        alignment: Alignment.centerRight,
                        padding: const EdgeInsets.only(right: 20),
                        decoration: BoxDecoration(
                          color: Colors.red.shade400,
                          borderRadius: BorderRadius.circular(12),
                        ),
                        child: const Icon(Icons.delete_outline_rounded,
                            color: Colors.white, size: 28),
                      ),
                      onDismissed: (_) {
                        provider.removeTodo(todo.id);
                        ScaffoldMessenger.of(ctx).showSnackBar(
                          SnackBar(
                            content: Text('"${todo.title}" dihapus'),
                            duration: const Duration(seconds: 2),
                          ),
                        );
                      },
                      child: Container(
                        decoration: BoxDecoration(
                          color: Colors.white,
                          borderRadius: BorderRadius.circular(12),
                          boxShadow: [
                            BoxShadow(
                              color: Colors.black.withOpacity(0.05),
                              blurRadius: 4,
                              offset: const Offset(0, 2),
                            )
                          ],
                        ),
                        child: ListTile(
                          contentPadding: const EdgeInsets.symmetric(
                              horizontal: 16, vertical: 4),
                          leading: Checkbox(
                            value: todo.isDone,
                            activeColor: Colors.indigo,
                            shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(4)),
                            onChanged: (_) => provider.toggleTodo(todo.id),
                          ),
                          title: Text(
                            todo.title,
                            style: TextStyle(
                              decoration: todo.isDone
                                  ? TextDecoration.lineThrough
                                  : null,
                              color:
                                  todo.isDone ? Colors.grey : Colors.black87,
                              fontWeight: FontWeight.w500,
                            ),
                          ),
                          trailing: IconButton(
                            icon: const Icon(Icons.delete_outline_rounded,
                                color: Colors.redAccent),
                            onPressed: () => provider.removeTodo(todo.id),
                            tooltip: 'Hapus tugas',
                          ),
                        ),
                      ),
                    );
                  },
                );
              },
            ),
          ),
        ],
      ),

      // ── FAB: Tampilkan FCM Token ──
      floatingActionButton: FloatingActionButton.extended(
        backgroundColor: Colors.indigo,
        foregroundColor: Colors.white,
        icon: const Icon(Icons.token_rounded),
        label: const Text('FCM Token'),
        onPressed: () => _showTokenDialog(context),
      ),
    );
  }

  // Dialog untuk melihat & copy FCM Token
  void _showTokenDialog(BuildContext context) {
    // Token disimpan di state yang di-pass dari main.dart via provider
    // Kita ambil dari FcmTokenProvider (lihat main.dart)
    final tokenProvider = context.read<FcmTokenProvider>();
    showDialog(
      context: context,
      builder: (ctx) => AlertDialog(
        title: const Row(
          children: [
            Icon(Icons.key_rounded, color: Colors.indigo),
            SizedBox(width: 8),
            Text('FCM Token'),
          ],
        ),
        content: Column(
          mainAxisSize: MainAxisSize.min,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
              'Gunakan token ini untuk kirim notifikasi via Firebase Console atau Postman:',
              style: TextStyle(fontSize: 12, color: Colors.grey),
            ),
            const SizedBox(height: 12),
            Container(
              padding: const EdgeInsets.all(10),
              decoration: BoxDecoration(
                color: Colors.grey.shade100,
                borderRadius: BorderRadius.circular(8),
              ),
              child: SelectableText(
                tokenProvider.token ?? 'Memuat token...',
                style: const TextStyle(fontSize: 11, fontFamily: 'monospace'),
              ),
            ),
          ],
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(ctx),
            child: const Text('Tutup'),
          ),
          FilledButton.icon(
            icon: const Icon(Icons.copy_rounded, size: 16),
            label: const Text('Salin Token'),
            onPressed: () {
              if (tokenProvider.token != null) {
                Clipboard.setData(ClipboardData(text: tokenProvider.token!));
                Navigator.pop(ctx);
                ScaffoldMessenger.of(context).showSnackBar(
                  const SnackBar(
                    content: Text('Token berhasil disalin!'),
                    backgroundColor: Colors.indigo,
                  ),
                );
              }
            },
          ),
        ],
      ),
    );
  }
}

// Provider kecil untuk simpan FCM token
class FcmTokenProvider extends ChangeNotifier {
  String? _token;
  String? get token => _token;

  void setToken(String? token) {
    _token = token;
    notifyListeners();
  }
}
