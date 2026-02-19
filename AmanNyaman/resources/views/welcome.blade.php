<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>AmanNyaman // COMMAND_CENTER</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background: radial-gradient(circle at center, #070707 0%, #000 100%); font-family: 'Courier New', monospace; }
        .cyber-border { border: 1px solid #1e3a8a; box-shadow: 0 0 15px rgba(30, 58, 138, 0.1); }
        .hidden-tab { display: none !important; }
    </style>
</head>
<body class="text-blue-500 p-4 md:p-10">
    <div class="max-w-7xl mx-auto">
        <div class="mb-10 border-b border-blue-900 pb-4 flex justify-between items-end">
            <div>
                <h1 class="text-2xl font-black text-white tracking-tighter uppercase">🛡️ Aman_Nyaman.sys</h1>
                <p class="text-[9px] text-blue-800 tracking-[0.4em] uppercase">Security Management Portal v5.0</p>
            </div>
            <div class="flex gap-2 flex-wrap justify-end uppercase font-bold">
                <button onclick="switchTab('brankas')" id="btn-brankas" class="text-[9px] border border-blue-600 px-3 py-2 bg-blue-600 text-white">1. Vault</button>
                <button onclick="switchTab('checker')" id="btn-checker" class="text-[9px] border border-blue-900 px-3 py-2 hover:bg-blue-900/20 text-blue-400">2. Audit</button>
                <button onclick="switchTab('paper')" id="btn-paper" class="text-[9px] border border-blue-900 px-3 py-2 hover:bg-blue-900/20 text-blue-400">3. Paper</button>
                <button onclick="switchTab('phish')" id="btn-phish" class="text-[9px] border border-blue-900 px-3 py-2 hover:bg-blue-900/20 text-blue-400">4. Phish</button>
                <button onclick="switchTab('malware')" id="btn-malware" class="text-[9px] border border-blue-900 px-3 py-2 hover:bg-blue-900/20 text-blue-400">5. Malware</button>
            </div>
        </div>

        @if(session('msg')) <div class="mb-6 p-3 border border-yellow-900 bg-yellow-950/20 text-yellow-500 text-[9px] font-bold animate-pulse">{{ session('msg') }}</div> @endif

        <div id="tab-brankas" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-3">
                <form action="/save" method="POST" class="cyber-border bg-black/40 p-6 space-y-4">
                    @csrf
                    <h2 class="text-[9px] font-bold text-blue-300 uppercase">>> New_Vault_Entry</h2>
                    <input type="text" name="perangkat" placeholder="ASET" class="w-full bg-black border border-blue-900/40 p-3 text-xs text-blue-400 outline-none focus:border-blue-500" required>
                    <input type="text" name="username" placeholder="USER_ID" class="w-full bg-black border border-blue-900/40 p-3 text-xs text-blue-400 outline-none focus:border-blue-500" required>
                    <input type="password" name="password" placeholder="PASSWORD" class="w-full bg-black border border-blue-900/40 p-3 text-xs text-blue-400 outline-none focus:border-blue-500" required>
                    <button class="w-full bg-blue-900/20 border border-blue-600 py-3 text-[10px] font-black hover:bg-blue-600 hover:text-white transition-all">EXECUTE</button>
                </form>
            </div>
            <div class="lg:col-span-9 overflow-x-auto cyber-border bg-black/40">
                <table class="w-full text-[10px] text-left">
                    <thead class="bg-blue-950/20 text-blue-400 border-b border-blue-900 uppercase">
                        <tr><th class="p-4">Asset</th><th class="p-4">Identity</th><th class="p-4">Secret</th><th class="p-4 text-center">Integrity</th><th class="p-4 text-center">Expiry</th></tr>
                    </thead>
                    <tbody class="divide-y divide-blue-900/20">
                        @foreach($data as $v)
                        <tr class="hover:bg-blue-900/5">
                            <td class="p-4 text-white font-bold uppercase">{{ $v->perangkat }}</td>
                            <td class="p-4 opacity-60">{{ $v->username }}</td>
                            <td class="p-4"><div class="flex items-center gap-2"><span id="pass-{{ $v->id }}" class="text-blue-900">••••••••</span><button onclick="toggleSecret('{{ $v->id }}', '{{ $v->password }}')" class="text-[8px] border border-blue-900 px-1 hover:text-white">VIEW</button></div></td>
                            <td class="p-4 text-center"><span class="px-2 py-0.5 border border-blue-900 text-[9px]">{{ $v->level }}</span></td>
                            <td class="p-4 text-center">
                                @php $diff = round(now()->diffInDays($v->expires_at, false)); $color = ($diff <= 0) ? 'text-red-500 animate-pulse' : (($diff <= 15) ? 'text-yellow-500' : 'text-blue-400'); @endphp
                                <span class="font-black {{ $color }}">{{ ($diff <= 0) ? 'EXPIRED' : $diff . ' D-LEFT' }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="tab-paper" class="hidden-tab grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-4">
                <form action="/upload" method="POST" enctype="multipart/form-data" class="cyber-border bg-black/40 p-6 space-y-4">
                    @csrf
                    <h2 class="text-[9px] font-bold text-blue-300 uppercase">>> Doc_Safe_Upload</h2>
                    <input type="text" name="nama_dokumen" placeholder="NAMA_DOKUMEN" class="w-full bg-black border border-blue-900/40 p-3 text-xs text-blue-400 outline-none" required>
                    <input type="file" name="file" class="text-[10px] text-blue-900 block w-full" required>
                    <button class="w-full bg-blue-900/20 border border-blue-600 py-3 text-[10px] font-black hover:bg-blue-600 transition-all uppercase">Deposit_File</button>
                </form>
            </div>
            <div class="lg:col-span-8 grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($docs as $doc)
                <div class="cyber-border bg-black/40 p-3 text-center">
                    <div class="h-20 bg-zinc-950 flex items-center justify-center text-[8px] text-blue-900 mb-2 border border-blue-900/20 uppercase">File_Secured</div>
                    <p class="text-[9px] text-white font-bold truncate">{{ $doc->nama_dokumen }}</p>
                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-[8px] text-blue-500 hover:text-white mt-2 block font-bold">ACCESS_DOC</a>
                </div>
                @endforeach
            </div>
        </div>

        <div id="tab-phish" class="hidden-tab max-w-2xl mx-auto py-16">
            <div class="cyber-border bg-black/40 p-10 text-center">
                <h2 class="text-white font-black mb-6 tracking-widest uppercase">Phish_Shield_Scanner</h2>
                <form action="/check-link" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" name="link" value="{{ session('link_input') }}" placeholder="https://..." class="w-full bg-black border border-blue-900 p-4 text-center text-blue-400 outline-none font-bold" required>
                    <button class="w-full bg-blue-900/20 border border-blue-600 py-4 text-[11px] font-black hover:bg-blue-600 transition-all uppercase">Verify_Link</button>
                </form>
                @if(session('hasil_link'))
                <div class="mt-8 p-6 border border-blue-900 bg-blue-950/10">
                    <h3 class="text-2xl font-black mb-2 uppercase" style="color: {{ session('hasil_link')['color'] }}">{{ session('hasil_link')['status'] }}</h3>
                    <p class="text-[10px] text-blue-300">"{{ session('hasil_link')['note'] }}"</p>
                </div>
                @endif
            </div>
        </div>

        <div id="tab-malware" class="hidden-tab max-w-2xl mx-auto py-16 text-center">
            <div class="cyber-border bg-black/40 p-10">
                <h2 class="text-white font-black mb-6 tracking-widest uppercase">Malware_Heuristic_Lab</h2>
                <form action="/scan-malware" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="file" name="file" class="text-[10px] text-blue-500 mb-4 block w-full" required>
                    <button class="w-full bg-blue-900/20 border border-blue-600 py-4 text-[11px] font-black hover:bg-blue-600 transition-all uppercase">Scan_File_Structure</button>
                </form>
                @if(session('hasil_scan'))
                <div class="mt-10 p-6 border border-blue-900 bg-blue-950/10 transition-all">
                    <p class="text-[8px] text-blue-800 uppercase mb-2">Analyzing: {{ session('file_name') }}</p>
                    <h3 class="text-3xl font-black uppercase mb-2" style="color: {{ session('hasil_scan')['color'] }}">{{ session('hasil_scan')['status'] }}</h3>
                    <p class="text-[10px] text-blue-300 italic border-t border-blue-900/30 pt-4">"{{ session('hasil_scan')['note'] }}"</p>
                </div>
                @endif
            </div>
        </div>

        <div id="tab-checker" class="hidden-tab max-w-xl mx-auto py-16 text-center">
            <div class="cyber-border bg-black/40 p-10">
                <h2 class="text-white font-black mb-8 tracking-widest uppercase">Integrity_Auditor</h2>
                <form action="/check" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" name="password" value="{{ session('pass_input') }}" placeholder="ENTER_STRING..." class="w-full bg-black border border-blue-900 p-4 text-center text-blue-400 outline-none font-bold" required>
                    <button class="w-full bg-blue-900/20 border border-blue-600 py-4 text-[11px] font-black hover:bg-blue-600 uppercase">Execute_Audit</button>
                </form>
                @if(session('hasil_cek'))
                <div class="mt-10 p-6 border border-blue-900 bg-blue-950/10">
                    <h3 class="text-4xl font-black uppercase tracking-[0.3em]" style="color: {{ session('hasil_cek')['hex'] }}">{{ session('hasil_cek')['level'] }}</h3>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function switchTab(mode) {
            const tabs = ['brankas', 'checker', 'paper', 'phish', 'malware'];
            tabs.forEach(t => {
                document.getElementById('tab-' + t).classList.add('hidden-tab');
                document.getElementById('btn-' + t).className = "text-[9px] border border-blue-900 px-3 py-2 hover:bg-blue-900/20 text-blue-400 transition-all";
            });
            document.getElementById('tab-' + mode).classList.remove('hidden-tab');
            document.getElementById('btn-' + mode).className = "text-[9px] border border-blue-600 px-3 py-2 bg-blue-600 text-white font-bold transition-all";
        }
        function toggleSecret(id, pass) {
            const el = document.getElementById('pass-' + id);
            if (el.innerText === '••••••••') { el.innerText = pass; el.classList.remove('text-blue-900'); el.classList.add('text-white', 'font-bold'); }
            else { el.innerText = '••••••••'; el.classList.remove('text-white', 'font-bold'); el.classList.add('text-blue-900'); }
        }
        @if(session('hasil_cek')) switchTab('checker'); @elseif(session('hasil_link')) switchTab('phish'); @elseif(session('hasil_scan')) switchTab('malware'); @elseif(session('tab') == 'paper') switchTab('paper'); @endif
    </script>
</body>
</html>