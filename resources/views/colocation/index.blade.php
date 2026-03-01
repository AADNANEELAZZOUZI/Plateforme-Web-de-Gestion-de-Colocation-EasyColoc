<x-app-layout>
    <div class="py-12 bg-slate-50 dark:bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(!$colocation)
                {{-- ÉCRAN 1 : L'UTILISATEUR N'A PAS DE COLOC --}}
                <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-xl sm:rounded-2xl p-12 text-center border border-slate-200 dark:border-slate-800">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-full mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-900 dark:text-white mb-4">Bienvenue sur EasyColoc !</h2>
                    <p class="text-slate-600 dark:text-slate-400 max-w-lg mx-auto mb-8 text-lg">
                        Vous n'appartenez à aucune colocation pour le moment. Créez votre propre groupe ou attendez une invitation par email.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg shadow-indigo-500/25">
                            Créer une colocation
                        </a>
                    </div>
                </div>

            @else
                {{-- ÉCRAN 2 : L'UTILISATEUR EST DANS UNE COLOC --}}
                
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-4xl font-black text-slate-900 dark:text-white flex items-center gap-3">
                            {{ $colocation->name }}
                            <span class="text-xs bg-green-500/10 text-green-500 px-3 py-1 rounded-full uppercase tracking-widest font-bold">Actif</span>
                        </h1>
                        <p class="text-slate-500 dark:text-slate-400 mt-1">Gérez vos dépenses communes et vos remboursements.</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('dépense.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold transition-all flex items-center gap-2 shadow-lg shadow-indigo-500/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Nouvelle dépense
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Total dépenses</p>
                        <p class="text-3xl font-black text-slate-900 dark:text-white">{{ number_format($dépenses->sum('amount'), 2) }} €</p>
                    </div>
                    <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Ma part</p>
                        <p class="text-3xl font-black text-indigo-600 dark:text-indigo-400">Calcul en cours...</p>
                    </div>
                    <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Membres</p>
                        <p class="text-3xl font-black text-slate-900 dark:text-white"></p>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/50">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Historique des dépenses</h3>
                        <button class="text-sm text-indigo-600 font-bold hover:underline">Voir tout</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-slate-400 text-xs uppercase tracking-widest border-b border-slate-100 dark:border-slate-800">
                                    <th class="px-6 py-4 font-bold">Titre</th>
                                    <th class="px-6 py-4 font-bold">Payeur</th>
                                    <th class="px-6 py-4 font-bold text-right">Montant</th>
                                    <th class="px-6 py-4 font-bold text-center">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                @forelse($dépenses as $dépense)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <span class="block font-bold text-slate-900 dark:text-white">{{ $dépense->title }}</span>
                                            <span class="text-xs text-slate-500 italic">{{ $dépense->catégorie->name ?? 'Sans catégorie' }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">
                                            
                                            {{ $dépense->payeur->name }}
                                        </td>
                                        <td class="px-6 py-4 text-right font-black text-slate-900 dark:text-white">
                                            {{ number_format($dépense->amount, 2) }} €
                                        </td>
                                        <td class="px-6 py-4 text-center text-slate-500 text-sm">
                                            {{ \Carbon\Carbon::parse($dépense->date)->translatedFormat('d M Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-slate-500 italic">
                                            Aucune dépense enregistrée pour le moment.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>