import 'package:flutter/material.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Tugas Praktikum Modul 1-5',
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: const ModulTujuhScreen(),
      debugShowCheckedModeBanner: false,
    );
  }
}

class ModulTujuhScreen extends StatelessWidget {
  const ModulTujuhScreen({super.key});

  @override
  Widget build(BuildContext context) {
    final List<String> dataArray = [
      'Data Array 1 - Apel',
      'Data Array 2 - Mangga',
      'Data Array 3 - Jeruk',
      'Data Array 4 - Anggur'
    ];

    return Scaffold(
      appBar: AppBar(
        title: const Text('Tugas Flutter - Pertemuan 7'),
        backgroundColor: Colors.blueAccent,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            /* ==========================================
               1. CONTAINER (Kotak Berwarna)
               ========================================== */
            const Text('1. Container', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
            const SizedBox(height: 8),
            Container(
              width: double.infinity,
              height: 80,
              decoration: BoxDecoration(
                color: Colors.amber, 
                borderRadius: BorderRadius.circular(10),
              ),
              child: const Center(
                child: Text('Ini adalah Container Berwarna', style: TextStyle(fontWeight: FontWeight.bold)),
              ),
            ),
            const SizedBox(height: 24),

            /* ==========================================
               2. GRIDVIEW (Minimal 6 Item)
               ========================================== */
            const Text('2. GridView', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
            const SizedBox(height: 8),
            GridView.count(
              shrinkWrap: true,
              physics: const NeverScrollableScrollPhysics(), 
              crossAxisCount: 3, 
              crossAxisSpacing: 10,
              mainAxisSpacing: 10,
              children: List.generate(6, (index) { 
                return Container(
                  color: Colors.teal[(index + 1) * 100],
                  child: Center(child: Text('Grid ${index + 1}')),
                );
              }),
            ),
            const SizedBox(height: 24),

            /* ==========================================
               3. LISTVIEW (3 Item A, B, C)
               ========================================== */
            const Text('3. ListView', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
            const SizedBox(height: 8),
            Container(
              decoration: BoxDecoration(border: Border.all(color: Colors.grey)),
              child: ListView(
                shrinkWrap: true,
                physics: const NeverScrollableScrollPhysics(),
                children: const [
                  ListTile(leading: CircleAvatar(child: Text('A')), title: Text('Item Pertama')),
                  ListTile(leading: CircleAvatar(child: Text('B')), title: Text('Item Kedua')),
                  ListTile(leading: CircleAvatar(child: Text('C')), title: Text('Item Ketiga')),
                ],
              ),
            ),
            const SizedBox(height: 24),

            /* ==========================================
               4. LISTVIEW.BUILDER (Dari Data Array)
               ========================================== */
            const Text('4. ListView.builder', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
            const SizedBox(height: 8),
            Container(
              color: Colors.blue[50],
              child: ListView.builder(
                shrinkWrap: true,
                physics: const NeverScrollableScrollPhysics(),
                itemCount: dataArray.length,
                itemBuilder: (context, index) {
                  return ListTile(
                    leading: const Icon(Icons.arrow_right),
                    title: Text(dataArray[index]),
                  );
                },
              ),
            ),
            const SizedBox(height: 24),

            /* ==========================================
               5. LISTVIEW.SEPARATED (Dengan Garis Pembatas)
               ========================================== */
            const Text('5. ListView.separated', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
            const SizedBox(height: 8),
            Container(
              decoration: BoxDecoration(border: Border.all(color: Colors.grey)),
              child: ListView.separated(
                shrinkWrap: true,
                physics: const NeverScrollableScrollPhysics(),
                itemCount: 4,
                // Ini garis pembatasnya
                separatorBuilder: (context, index) => const Divider(color: Colors.red, thickness: 2),
                itemBuilder: (context, index) {
                  return Padding(
                    padding: const EdgeInsets.all(12.0),
                    child: Text('List Data ke-${index + 1}'),
                  );
                },
              ),
            ),
            const SizedBox(height: 24),

            /* ==========================================
               6. STACK (Tampilan Bertumpuk)
               ========================================== */
            const Text('6. Stack', style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
            const SizedBox(height: 8),
            Stack(
              alignment: Alignment.center,
              children: [
                // Kotak Bawah
                Container(
                  width: double.infinity,
                  height: 150,
                  color: Colors.indigo,
                ),
                // Kotak Tengah
                Container(
                  width: 100,
                  height: 100,
                  color: Colors.orange,
                ),
                // Teks Atas
                const Text(
                  'Teks Bertumpuk',
                  style: TextStyle(
                    color: Colors.white,
                    fontWeight: FontWeight.bold,
                    fontSize: 20,
                  ),
                ),
              ],
            ),
            const SizedBox(height: 40),
          ],
        ),
      ),
    );
  }
}