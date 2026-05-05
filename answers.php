<?php
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: index.html');
    exit();
}

$name = $_SESSION["name"];
$email = $_SESSION["email"] ?? '';
?>
<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Respostas às perguntas de Redes e Apache — Projeto Final SI por Eric Simões 3ºPIS">
    <title>Respostas de Redes e Apache — Projeto SI</title>
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="output.css">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* ── User pill ── */
        .user-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(9, 19, 40, 0.9);
            border: 1px solid #192540;
            border-radius: 50px;
            padding: 6px 14px 6px 10px;
            cursor: default;
        }

        .user-pill .pill-name {
            font-size: 14px;
            font-weight: 500;
            color: #dee5ff;
            white-space: nowrap;
        }

        .user-pill .avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #1a2d50;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .btn-gear {
            background: transparent;
            border: none;
            color: #a3aac4;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            border-radius: 6px;
            transition: color 0.15s, background 0.15s;
        }

        .btn-gear:hover {
            color: #dee5ff;
            background: rgba(255, 255, 255, 0.06);
        }

        /* ── Overlay backdrop ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 9000;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(4px);
            padding: 16px;
        }

        .modal-overlay[hidden] {
            display: none;
        }

        /* ── Account settings modal ── */
        .acct-modal {
            background: #091328;
            border: 1px solid #192540;
            border-radius: 14px;
            width: 100%;
            max-width: 340px;
            padding: 24px;
            position: relative;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.7);
        }

        .acct-modal .modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            background: transparent;
            border: none;
            color: #a3aac4;
            cursor: pointer;
            padding: 4px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            transition: color 0.15s, background 0.15s;
        }

        .acct-modal .modal-close:hover {
            color: #dee5ff;
            background: rgba(255, 255, 255, 0.06);
        }

        .acct-modal h2 {
            font-size: 18px;
            font-weight: 700;
            color: #dee5ff;
            margin: 0 0 2px;
        }

        .acct-modal .subtitle {
            font-size: 13px;
            color: #a3aac4;
            margin: 0 0 20px;
        }

        .acct-user-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .acct-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #1a2d50;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .acct-username {
            font-size: 15px;
            font-weight: 600;
            color: #dee5ff;
        }

        .acct-action-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #0d1c38;
            border: 1px solid #192540;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 10px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.15s;
        }

        .acct-action-row:last-child {
            margin-bottom: 0;
        }

        .acct-action-row:hover {
            background: #192540;
        }

        .acct-action-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .acct-action-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .acct-action-icon.logout {
            background: rgba(83, 221, 252, 0.12);
        }

        .acct-action-icon.delete {
            background: rgba(239, 68, 68, 0.15);
        }

        .acct-action-label {
            font-size: 14px;
            font-weight: 600;
            color: #dee5ff;
            margin: 0;
            line-height: 1.2;
        }

        .acct-action-desc {
            font-size: 12px;
            color: #a3aac4;
            margin: 0;
        }

        .acct-chevron {
            color: #a3aac4;
        }

        /* ── Delete warning modal ── */
        .del-modal {
            background: #091328;
            border: 1px solid #192540;
            border-radius: 14px;
            width: 100%;
            max-width: 320px;
            padding: 28px 24px 22px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.7);
        }

        .del-modal h2 {
            font-size: 20px;
            font-weight: 700;
            color: #dee5ff;
            margin: 0 0 10px;
        }

        .del-modal p {
            font-size: 13px;
            color: #a3aac4;
            margin: 0 0 22px;
            line-height: 1.6;
        }

        .btn-confirm-delete {
            width: 100%;
            padding: 13px;
            background: #ef4444;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 14px;
            transition: background 0.15s;
        }

        .btn-confirm-delete:hover {
            background: #dc2626;
        }

        .btn-cancel-delete {
            display: block;
            width: 100%;
            text-align: center;
            background: transparent;
            border: none;
            color: #a3aac4;
            font-size: 13px;
            cursor: pointer;
            padding: 0;
            transition: color 0.15s;
        }

        .btn-cancel-delete:hover {
            color: #dee5ff;
        }
    </style>
</head>

<body class="bg-bg text-text-primary min-h-screen font-sans">

    <!-- ── Header ── -->
    <header
        class="fixed top-0 left-0 w-full h-[80px] bg-[rgba(6,14,32,0.85)] backdrop-blur-md border-b border-border shadow-[0_4px_40px_rgba(0,0,0,0.4)] flex items-center justify-between px-12 z-50">
        <h1 class="text-cyan font-bold text-[20px] tracking-[-0.05em]">Eric Simões 3ºPIS</h1>
        <div class="user-pill">
            <div class="avatar">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="#53ddfc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
            </div>
            <span class="pill-name">Bem-vindo, <?= htmlspecialchars($name) ?></span>
            <button id="btn-open-account" class="btn-gear" aria-label="Configurações de conta">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3" />
                    <path
                        d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z" />
                </svg>
            </button>
        </div>
    </header>

    <!-- ── Main ── -->
    <main class="max-w-[1280px] mx-auto pt-[160px] pb-24 px-12 flex flex-col gap-16">

        <h1 class="text-text-primary text-[clamp(48px,6vw,72px)] font-extrabold tracking-[-0.05em] leading-none">
            Respostas</h1>

        <div class="grid grid-cols-6 gap-6 max-lg:grid-cols-4 max-sm:grid-cols-1">

            <!-- Tópico 01 — IPv4 -->
            <article
                class="group col-span-3 max-lg:col-span-4 max-sm:col-span-1 bg-surface rounded-[10px] overflow-hidden flex flex-col transition-all duration-250 ease-out hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(0,0,0,0.4)]">
                <div class="relative w-full h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800&q=80"
                        alt="Servidores de rede representando endereçamento IPv4"
                        class="w-full h-full object-cover grayscale opacity-75 transition-[opacity,filter] duration-300 ease-[ease] group-hover:opacity-90 group-hover:grayscale-[0.5]"
                        loading="lazy">
                    <span
                        class="absolute top-3.5 right-3.5 bg-badge text-badge-text text-[11px] font-bold tracking-[0.07em] px-3 py-1 rounded-full">TÓPICO
                        01</span>
                </div>
                <div class="flex flex-col gap-3.5 p-8 w-full">
                    <h2 class="text-text-primary text-[22px] font-semibold leading-snug m-0">1. O que é um endereço IPv4
                        e como se identifica no Windows?</h2>
                    <div class="border-l-2 border-cyan pl-4 py-1 w-full">
                        <p class="text-text-secondary text-[14px] leading-relaxed m-0">O IPv4 é um rótulo numérico de 32
                            bits que identifica cada dispositivo numa rede, permitindo que os pacotes de dados sejam
                            encaminhados corretamente para o destino pretendido dentro da infraestrutura.</p>
                    </div>
                </div>
            </article>

            <!-- Tópico 02 — Apache -->
            <article
                class="group col-span-3 max-lg:col-span-4 max-sm:col-span-1 bg-surface rounded-[10px] overflow-hidden flex flex-col transition-all duration-250 ease-out hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(0,0,0,0.4)]">
                <div class="relative w-full h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1544197150-b99a580bb7a8?w=800&q=80"
                        alt="Cabos de rede e infraestrutura Apache"
                        class="w-full h-full object-cover grayscale opacity-75 transition-[opacity,filter] duration-300 ease-[ease] group-hover:opacity-90 group-hover:grayscale-[0.5]"
                        loading="lazy">
                    <span
                        class="absolute top-3.5 right-3.5 bg-badge text-badge-text text-[11px] font-bold tracking-[0.07em] px-3 py-1 rounded-full">TÓPICO
                        02</span>
                </div>
                <div class="flex flex-col gap-3.5 p-8 w-full">
                    <h2 class="text-text-primary text-[22px] font-semibold leading-snug m-0">2. Porque outro PC consegue
                        aceder ao Apache através do IP?</h2>
                    <div class="border-l-2 border-cyan pl-4 py-1 w-full">
                        <p class="text-text-secondary text-[14px] leading-relaxed m-0">Desde que os dispositivos
                            partilhem a mesma gama de endereços, o sistema operativo permite a travessia de pacotes de
                            dados, tornando o conteúdo do Apache acessível a qualquer utilizador autorizado.</p>
                    </div>
                </div>
            </article>

            <!-- Tópico 03 -->
            <article
                class="group col-span-2 max-lg:col-span-2 max-sm:col-span-1 bg-surface rounded-[10px] overflow-hidden flex flex-col transition-all duration-250 ease-out hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(0,0,0,0.4)]">
                <div class="relative w-full h-40 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&q=80"
                        alt="Placa de circuito representando loopback vs rede local"
                        class="w-full h-full object-cover grayscale opacity-75 transition-[opacity,filter] duration-300 ease-[ease] group-hover:opacity-90 group-hover:grayscale-[0.5]"
                        loading="lazy">
                    <span
                        class="absolute top-3.5 right-3.5 bg-badge text-badge-text text-[11px] font-bold tracking-[0.07em] px-3 py-1 rounded-full">TÓPICO
                        03</span>
                </div>
                <div class="flex flex-col gap-3 px-6 pt-[22px] pb-[26px] w-full">
                    <h2 class="text-text-primary text-[18px] font-semibold leading-snug m-0">3. Diferença entre
                        localhost e 192.168.x.x?</h2>
                    <div class="border-l-2 border-cyan pl-4 py-1 w-full">
                        <p class="text-text-secondary text-[13px] leading-relaxed m-0">Enquanto o localhost funciona sem
                            necessidade de uma placa de rede ativa ou ligação à internet, o IP de rede depende
                            inteiramente da presença de um router que faça a gestão.</p>
                    </div>
                </div>
            </article>

            <!-- Tópico 04 -->
            <article
                class="group col-span-2 max-lg:col-span-2 max-sm:col-span-1 bg-surface rounded-[10px] overflow-hidden flex flex-col transition-all duration-250 ease-out hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(0,0,0,0.4)]">
                <div class="relative w-full h-40 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?w=600&q=80"
                        alt="Firewall e segurança de rede"
                        class="w-full h-full object-cover grayscale opacity-75 transition-[opacity,filter] duration-300 ease-[ease] group-hover:opacity-90 group-hover:grayscale-[0.5]"
                        loading="lazy">
                    <span
                        class="absolute top-3.5 right-3.5 bg-badge text-badge-text text-[11px] font-bold tracking-[0.07em] px-3 py-1 rounded-full">TÓPICO
                        04</span>
                </div>
                <div class="flex flex-col gap-3 px-6 pt-[22px] pb-[26px] w-full">
                    <h2 class="text-text-primary text-[18px] font-semibold leading-snug m-0">4. O que pode impedir o
                        acesso LAN?</h2>
                    <div class="border-l-2 border-cyan pl-4 py-1 w-full">
                        <p class="text-text-secondary text-[13px] leading-relaxed m-0">Geralmente o Windows Firewall
                            bloqueia as portas 80/443 por padrão, ou configurações de isolamento de cliente (AP
                            isolation) no router impedem a comunicação entre dispositivos.</p>
                    </div>
                </div>
            </article>

            <!-- Tópico 05 -->
            <article
                class="group col-span-2 max-lg:col-span-2 max-sm:col-span-1 bg-surface rounded-[10px] overflow-hidden flex flex-col transition-all duration-250 ease-out hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(0,0,0,0.4)]">
                <div class="relative w-full h-40 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=600&q=80"
                        alt="Teste de conectividade num segundo PC"
                        class="w-full h-full object-cover grayscale opacity-75 transition-[opacity,filter] duration-300 ease-[ease] group-hover:opacity-90 group-hover:grayscale-[0.5]"
                        loading="lazy">
                    <span
                        class="absolute top-3.5 right-3.5 bg-badge text-badge-text text-[11px] font-bold tracking-[0.07em] px-3 py-1 rounded-full">TÓPICO
                        05</span>
                </div>
                <div class="flex flex-col gap-3 px-6 pt-[22px] pb-[26px] w-full">
                    <h2 class="text-text-primary text-[18px] font-semibold leading-snug m-0">5. Como testar num segundo
                        PC da sala?</h2>
                    <div class="border-l-2 border-cyan pl-4 py-1 w-full">
                        <p class="text-text-secondary text-[13px] leading-relaxed m-0">Assegure que ambos estão no mesmo
                            Wi-Fi/LAN, descubra o IP do host (servidor) e digite esse IP diretamente no navegador do
                            segundo PC. Se não carregar, revise as regras de firewall.</p>
                    </div>
                </div>
            </article>

        </div>
    </main>

    <!-- ── Account Settings Modal ── -->
    <div id="modal-account" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="acct-modal-title"
        hidden>
        <div class="acct-modal">
            <button id="btn-close-account" class="modal-close" aria-label="Fechar">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
            <h2 id="acct-modal-title">Account Settings</h2>
            <p class="subtitle">Manage your profile preferences</p>
            <div class="acct-user-row">
                <div class="acct-avatar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                        stroke="#53ddfc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                </div>
                <span class="acct-username"><?= htmlspecialchars($name) ?></span>
            </div>
            <!-- Log out -->
            <a href="logout.php" class="acct-action-row" id="btn-logout">
                <div class="acct-action-left">
                    <div class="acct-action-icon logout">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none"
                            stroke="#53ddfc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            <polyline points="16 17 21 12 16 7" />
                            <line x1="21" y1="12" x2="9" y2="12" />
                        </svg>
                    </div>
                    <div>
                        <p class="acct-action-label">Log out</p>
                        <p class="acct-action-desc">End your current session</p>
                    </div>
                </div>
                <svg class="acct-chevron" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6" />
                </svg>
            </a>
            <!-- Delete account -->
            <button class="acct-action-row" id="btn-open-delete" style="width:100%;text-align:left;">
                <div class="acct-action-left">
                    <div class="acct-action-icon delete">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none"
                            stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6" />
                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                            <path d="M10 11v6" />
                            <path d="M14 11v6" />
                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                        </svg>
                    </div>
                    <div>
                        <p class="acct-action-label">Delete account</p>
                        <p class="acct-action-desc">Permanently remove your data</p>
                    </div>
                </div>
                <svg class="acct-chevron" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6" />
                </svg>
            </button>
        </div>
    </div>

    <!-- ── Delete Warning Modal ── -->
    <div id="modal-delete" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="del-modal-title"
        hidden>
        <div class="del-modal">
            <h2 id="del-modal-title">Delete account?</h2>
            <p>This action is permanent and cannot be undone. All your data will be removed.</p>
            <form action="delete_account.php" method="post">
                <button type="submit" class="btn-confirm-delete">Confirm Deletion</button>
            </form>
            <button class="btn-cancel-delete" id="btn-cancel-delete">Cancel and keep account</button>
        </div>
    </div>

    <script>
        (function () {
            const accountModal = document.getElementById('modal-account');
            const deleteModal = document.getElementById('modal-delete');

            function openModal(m) { m.hidden = false; document.body.style.overflow = 'hidden'; }
            function closeModal(m) { m.hidden = true; document.body.style.overflow = ''; }

            document.getElementById('btn-open-account').addEventListener('click', () => openModal(accountModal));
            document.getElementById('btn-close-account').addEventListener('click', () => closeModal(accountModal));

            document.getElementById('btn-open-delete').addEventListener('click', () => {
                closeModal(accountModal);
                openModal(deleteModal);
            });
            document.getElementById('btn-cancel-delete').addEventListener('click', () => {
                closeModal(deleteModal);
                openModal(accountModal);
            });

            [accountModal, deleteModal].forEach(m => {
                m.addEventListener('click', e => { if (e.target === m) closeModal(m); });
            });

            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') {
                    if (!accountModal.hidden) closeModal(accountModal);
                    if (!deleteModal.hidden) closeModal(deleteModal);
                }
            });
        })();
    </script>

</body>

</html>