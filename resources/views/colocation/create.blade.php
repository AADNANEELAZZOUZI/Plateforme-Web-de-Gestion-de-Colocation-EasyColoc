<x-app-layout>
    <div class="py-12 bg-slate-50 dark:bg-slate-950 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6">
                <a href="{{ route('dashboard') }}" class="text-indigo-600 flex items-center gap-2 font-bold hover:underline transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Retour au tableau de bord
                </a>
            </div>

            <div class="bg-white dark:bg-slate-900 shadow-xl rounded-3xl overflow-hidden border border-slate-200 dark:border-slate-800">
                
                <div class="p-8 border-b border-slate-100 dark:border-slate-800 bg-gradient-to-r from-indigo-500/10 to-transparent">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="p-3 bg-indigo-600 rounded-2xl text-white shadow-lg shadow-indigo-500/30">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Nouvelle Coloc</h2>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400">Créez votre espace commun pour commencer à diviser vos factures.</p>
                </div>

                <form action="{{ route('colocation.store') }}" method="POST" class="p-8 space-y-8">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-sm font-black text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                            Nom de votre colocation
                        </label>
                        <input type="text" name="name" id="name" required 
                            placeholder="Ex: Appartement de la Plage, La Villa 404..." 
                            class="w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-lg font-medium shadow-sm">
                        @error('name')
                            <p class="text-red-500 text-xs mt-2 font-bold italic">{{ $message }}</p>
                        @enderror
                    </div>


                    <hr class="border-slate-100 dark:border-slate-800">

                    <div class="bg-indigo-50 dark:bg-indigo-900/20 p-4 rounded-2xl flex items-start gap-4 border border-indigo-100 dark:border-indigo-900/50">
                        <svg class="w-6 h-6 text-indigo-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-indigo-800 dark:text-indigo-300 leading-relaxed">
                            <strong>Note :</strong> En créant cette colocation, vous en deviendrez l'administrateur. Vous pourrez inviter vos colocataires par email juste après cette étape.
                        </p>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-indigo-500/30 flex justify-center items-center gap-3 group">
                            C'est parti !
                            <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>