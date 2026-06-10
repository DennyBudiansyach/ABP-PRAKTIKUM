import 'package:flutter/material.dart';

// Model data untuk satu tugas
class TodoItem {
  final String id;
  final String title;
  bool isDone;

  TodoItem({
    required this.id,
    required this.title,
    this.isDone = false,
  });
}

// Provider: mengelola state daftar tugas
class TodoProvider extends ChangeNotifier {
  final List<TodoItem> _todos = [];

  // Getter: list tugas (read-only dari luar)
  List<TodoItem> get todos => List.unmodifiable(_todos);

  // Jumlah tugas selesai
  int get doneCount => _todos.where((t) => t.isDone).length;

  // Tambah tugas baru
  void addTodo(String title) {
    if (title.trim().isEmpty) return;
    _todos.add(
      TodoItem(
        id: DateTime.now().millisecondsSinceEpoch.toString(),
        title: title.trim(),
      ),
    );
    notifyListeners();
  }

  // Toggle status selesai/belum
  void toggleTodo(String id) {
    final index = _todos.indexWhere((t) => t.id == id);
    if (index != -1) {
      _todos[index].isDone = !_todos[index].isDone;
      notifyListeners();
    }
  }

  // Hapus satu tugas
  void removeTodo(String id) {
    _todos.removeWhere((t) => t.id == id);
    notifyListeners();
  }

  // Hapus SELURUH tugas
  void clearAllTodos() {
    _todos.clear();
    notifyListeners();
  }

  // Tambah tugas dari notifikasi FCM
  void addTodoFromNotification(String title) {
    addTodo('📬 [FCM] $title');
  }
}
