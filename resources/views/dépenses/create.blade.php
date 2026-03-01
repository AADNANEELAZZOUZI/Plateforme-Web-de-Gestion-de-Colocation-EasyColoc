<x-app-layout>
    <div class="py-12 bg-slate-50 dark:bg-slate-950 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <a href="{{ route('colocation.index') }}"
                    class="text-indigo-600 flex items-center gap-2 font-bold hover:underline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Retour à la colocation
                </a>
            </div>

            <div
                class="bg-white dark:bg-slate-900 shadow-xl rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-800">
                <div class="p-8 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/50">
                    <h2 class="text-2xl font-black text-slate-900 dark:text-white">Ajouter une dépense</h2>
                    <p class="text-slate-500">Elle sera divisée équitablement entre les membres.</p>
                </div>

                <form action="{{ route('dépense.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf

                    <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Titre de la
                                dépense</label>
                            <input type="text" name="title" required placeholder="Ex: Courses Lidl, Facture Eau..."
                                class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Montant
                                (€)</label>
                            <div class="relative">
                                <input type="number" step="0.01" name="amount" required placeholder="0.00"
                                    class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 pl-10">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                    €</div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Date</label>
                            <input type="date" name="date" value="{{ date('Y-m-d') }}" required
                                class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label
                                class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Catégorie</label>
                            <select name="catégorie_id" required
                                class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Qui a payé
                                ?</label>
                            <select name="payeur_id"
                                class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                                @foreach($colocation->members as $membre)
                                    <option value="{{ $membre->id }}" {{ $membre->id == auth()->id() ? 'selected' : '' }}>
                                        {{ $membre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-xl transition-all shadow-lg shadow-indigo-500/25 flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Enregistrer et partager
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>