<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyColoc - Gestion de colocation simplifiée</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            900: '#1e1b4b', // Darker indigo for sidebar
                        },
                        secondary: '#10b981', 
                        darkBg: '#0f172a', // Slate 900
                        darkCard: '#1e293b', // Slate 800
                    }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .fade-in { animation: fadeIn 0.3s ease-out forwards; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Custom scrollbar for the dashboard mockup */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    </style>
</head>
<body class="bg-darkBg text-slate-200 antialiased">

    <nav class="sticky top-0 z-50 bg-darkBg/80 backdrop-blur-md border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="#" class="flex items-center gap-2 text-primary-500 font-bold text-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    EasyColoc
                </a>

                <div class="hidden md:flex space-x-8 items-center">
                    <div class="flex items-center gap-3">
                    <a href="/login" class="text-slate-300 hover:text-white transition">Se connecter</a>
<a href="/register" class="w-full sm:w-auto bg-primary-600 text-white px-8 py-2.5 rounded-xl font-bold text-lg shadow-lg hover:bg-primary-700 hover:shadow-primary-500/20 transition-all text-center">
    S'inscrire
</a>                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section class="relative pt-20 pb-32 overflow-hidden">
        <div class="absolute top-0 left-1/2 w-full -translate-x-1/2 h-full z-0 pointer-events-none">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[500px] bg-primary-900/20 rounded-full blur-3xl opacity-50"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-white mb-6">
                Gérez votre colocation <span class="text-primary-500">sans stress</span>
            </h1>
            <p class="text-xl text-slate-400 max-w-2xl mx-auto mb-10">
                Suivez les dépenses communes, calculez automatiquement les dettes et comprenez enfin « qui doit quoi à qui ».
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <button onclick="openModal('register')" class="w-full sm:w-auto bg-primary-600 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg hover:bg-primary-700 hover:shadow-primary-500/20 transition-all">
                    Créer une colocation
                </button>
                <button onclick="document.getElementById('demo').scrollIntoView({behavior: 'smooth'})" class="w-full sm:w-auto bg-slate-800 text-slate-200 border border-slate-700 px-8 py-4 rounded-xl font-bold text-lg hover:bg-slate-700 transition-all">
                    Voir comment ça marche
                </button>
            </div>
        </div>
    </section>

    <section id="demo" class="bg-slate-950 py-20 border-t border-slate-800">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-white">Une vision claire de vos finances</h2>
                <p class="text-slate-500 mt-2">L'interface intuitive conçue pour simplifier la vie des propriétaires et colocataires.</p>
            </div>

            <div class="bg-darkCard rounded-2xl shadow-2xl border border-slate-700 overflow-hidden flex flex-col md:flex-row min-h-[600px] fade-in">
                
                <aside class="w-full md:w-64 bg-slate-900 text-slate-300 flex-shrink-0 flex flex-col justify-between hidden md:flex border-r border-slate-700">
                    <div class="p-6">
                        <div class="flex items-center gap-2 font-bold text-xl mb-10 text-white">
                            <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            EasyColoc
                        </div>
                        
                        <nav class="space-y-2">
                            <a href="#" class="flex items-center gap-3 px-4 py-3 bg-primary-600/10 text-primary-400 rounded-lg font-medium">
                                📊 Tableau de bord
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-800 rounded-lg transition">
                                💸 Dépenses
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-800 rounded-lg transition">
                                ⚖️ Soldes & Dettes
                            </a>
                        </nav>
                    </div>
                    
                    <div class="p-6 border-t border-slate-800">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-secondary text-white flex items-center justify-center font-bold text-xs">JD</div>
                            <div>
                                <div class="text-sm font-semibold text-white">Jean Dupont</div>
                                <div class="text-xs text-slate-500">Admin Global</div>
                            </div>
                        </div>
                    </div>
                </aside>

                <main class="flex-1 bg-slate-800/50 overflow-y-auto p-6 md:p-8 custom-scrollbar">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                        <div>
                            <div class="text-sm text-slate-500 mb-1">Colocation / Appartement Paris 11</div>
                            <h3 class="text-2xl font-bold text-white">Vue d'ensemble</h3>
                        </div>
                        <button class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                            + Ajouter une dépense
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-slate-800 p-6 rounded-xl border border-slate-700 shadow-sm">
                            <div class="text-slate-400 text-sm font-medium mb-2">Votre solde total</div>
                            <div class="text-3xl font-bold text-secondary">+ 45,00 €</div>
                        </div>
                        <div class="bg-slate-800 p-6 rounded-xl border border-slate-700 shadow-sm">
                            <div class="text-slate-400 text-sm font-medium mb-2">Dépenses ce mois</div>
                            <div class="text-3xl font-bold text-white">1 240,50 €</div>
                        </div>
                        <div class="bg-slate-800 p-6 rounded-xl border border-slate-700 shadow-sm">
                            <div class="text-slate-400 text-sm font-medium mb-2">Membres actifs</div>
                            <div class="text-3xl font-bold text-white">4</div>
                        </div>
                    </div>

                    <div class="bg-slate-800 rounded-xl border border-slate-700 p-6">
                        <h4 class="text-lg font-bold text-white mb-4">Remboursements suggérés</h4>
                        <div class="flex flex-col sm:flex-row justify-between items-center py-4 border-b border-slate-700 gap-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-red-900/30 text-red-400 flex items-center justify-center font-bold text-xs">SB</div>
                                <div class="font-bold text-sm text-slate-200">Sarah B.</div>
                                <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                <div class="font-bold text-sm text-slate-200">Vous</div>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="font-bold text-red-400">25,00 €</span>
                                <button class="text-xs bg-slate-700 border border-slate-600 px-3 py-1.5 rounded hover:bg-slate-600 text-slate-200">Marquer payé</button>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>

    <section id="features" class="py-20 bg-darkBg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-white">Fonctionnalités clés</h2>
                <p class="text-slate-500 mt-4 max-w-2xl mx-auto">Tout ce dont vous avez besoin pour une vie en communauté sereine.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="p-6 rounded-2xl border border-slate-800 bg-slate-900/50 hover:border-primary-500/50 transition group">
                    <div class="w-12 h-12 bg-primary-900/30 text-primary-400 rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-white">Calculs Automatisés</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Plus de calculs fastidieux. Notre algorithme s'occupe de tout.</p>
                </div>
                </div>
        </div>
    </section>

    <footer class="bg-slate-950 text-slate-500 pt-16 pb-8 border-t border-slate-900">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="text-white text-xl font-bold mb-4 flex justify-center items-center gap-2">
                <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                EasyColoc
            </div>
            <p class="text-sm mb-8">© 2023 EasyColoc. Projet étudiant Développeur Web.</p>
        </div>
    </footer>

    <div id="modal-login" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" onclick="closeModal('login')"></div>
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl w-full max-w-md p-8 fade-in relative z-10">
                <h2 class="text-2xl font-bold text-white mb-6 text-center">Connexion</h2>
                <form onsubmit="event.preventDefault(); closeModal('login');">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-400 mb-1">Email</label>
                        <input type="email" class="w-full bg-slate-800 px-4 py-2 rounded-lg border border-slate-700 text-white focus:ring-2 focus:ring-primary-500 outline-none transition" placeholder="vous@exemple.com">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-slate-400 mb-1">Mot de passe</label>
                        <input type="password" class="w-full bg-slate-800 px-4 py-2 rounded-lg border border-slate-700 text-white focus:ring-2 focus:ring-primary-500 outline-none transition" placeholder="********">
                    </div>
                    <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-2.5 rounded-lg transition shadow-md">Se connecter</button>
                </form>
            </div>
        </div>
    </div>

    <div id="modal-register" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" onclick="closeModal('register')"></div>
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl w-full max-w-md p-8 fade-in relative z-10">
                <h2 class="text-2xl font-bold text-white mb-6 text-center">Créer un compte</h2>
                <form onsubmit="event.preventDefault(); closeModal('register');">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-400 mb-1">Nom complet</label>
                        <input type="text" class="w-full bg-slate-800 px-4 py-2 rounded-lg border border-slate-700 text-white focus:ring-2 focus:ring-primary-500 outline-none transition" placeholder="Jean Dupont">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-400 mb-1">Email</label>
                        <input type="email" class="w-full bg-slate-800 px-4 py-2 rounded-lg border border-slate-700 text-white focus:ring-2 focus:ring-primary-500 outline-none transition" placeholder="vous@exemple.com">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-slate-400 mb-1">Mot de passe</label>
                        <input type="password" class="w-full bg-slate-800 px-4 py-2 rounded-lg border border-slate-700 text-white focus:ring-2 focus:ring-primary-500 outline-none transition" placeholder="********">
                    </div>
                    <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-2.5 rounded-lg transition">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(`modal-${id}`).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function closeModal(id) {
            document.getElementById(`modal-${id}`).classList.add('hidden');
            document.body.style.overflow = '';
        }
    </script>
</body>
</html>