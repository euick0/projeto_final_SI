<?php

session_start();

if (isset($_SESSION["name"])) {
    $name = $_SESSION["name"];
} else {
    echo "<script>window.location.href = 'index.html';</script>";
    exit();
}

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
</head>

<body class="bg-bg text-text-primary min-h-screen font-sans">

    <!-- ── Header ── -->
    <header
        class="fixed top-0 left-0 w-full h-[80px] bg-[rgba(6,14,32,0.85)] backdrop-blur-md border-b border-border shadow-[0_4px_40px_rgba(0,0,0,0.4)] flex items-center justify-between px-12 z-50">
        <h1 class="text-cyan font-bold text-[20px] tracking-[-0.05em] no-underline">
            Eric Simões 3ºPIS
        </h1>
        <div>
            <p class="p-0 m-0 font-medium text-[16px]">Olá, Utilizador!</p>
        </div>

    </header>

    <!-- ── Main ── -->
    <main class="max-w-[1280px] mx-auto pt-[160px] pb-24 px-12 flex flex-col gap-16">

        <!-- Hero -->
        <h1 class="text-text-primary text-[clamp(48px,6vw,72px)] font-extrabold tracking-[-0.05em] leading-none">
            Respostas
        </h1>

        <!-- Bento Grid -->
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
                        class="absolute top-3.5 right-3.5 bg-badge text-badge-text text-[11px] font-bold tracking-[0.07em] px-3 py-1 rounded-full">
                        TÓPICO 01
                    </span>
                </div>
                <div class="flex flex-col gap-3.5 p-8 w-full">
                    <h2 class="text-text-primary text-[22px] font-semibold leading-snug m-0">
                        1. O que é um endereço IPv4 e como se identifica no Windows?
                    </h2>
                    <div class="border-l-2 border-cyan pl-4 py-1 w-full">
                        <p class="text-text-secondary text-[14px] leading-relaxed m-0">
                            O IPv4 é um rótulo numérico de 32 bits. No Windows, utilize o comando
                            <code
                                class="font-mono text-[0.88em] bg-[#192540] text-cyan px-1.5 py-px rounded-[3px]">ipconfig</code>
                            no CMD (Prompt de Comando) para visualizar os detalhes da sua interface de rede.
                        </p>
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
                        class="absolute top-3.5 right-3.5 bg-badge text-badge-text text-[11px] font-bold tracking-[0.07em] px-3 py-1 rounded-full">
                        TÓPICO 02
                    </span>
                </div>
                <div class="flex flex-col gap-3.5 p-8 w-full">
                    <h2 class="text-text-primary text-[22px] font-semibold leading-snug m-0">
                        2. Porque outro PC consegue aceder ao Apache através do IP?
                    </h2>
                    <div class="border-l-2 border-cyan pl-4 py-1 w-full">
                        <p class="text-text-secondary text-[14px] leading-relaxed m-0">
                            Isso ocorre porque o IP aponta diretamente para a máquina onde o serviço Apache está
                            "ouvindo" em uma porta específica (geralmente 80 para HTTP), processando a requisição e
                            devolvendo os arquivos do site através do protocolo TCP/IP.
                        </p>
                    </div>
                </div>
            </article>

            <!-- Tópico 03 — Localhost vs IP -->
            <article
                class="group col-span-2 max-lg:col-span-2 max-sm:col-span-1 bg-surface rounded-[10px] overflow-hidden flex flex-col transition-all duration-250 ease-out hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(0,0,0,0.4)]">
                <div class="relative w-full h-40 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&q=80"
                        alt="Placa de circuito representando loopback vs rede local"
                        class="w-full h-full object-cover grayscale opacity-75 transition-[opacity,filter] duration-300 ease-[ease] group-hover:opacity-90 group-hover:grayscale-[0.5]"
                        loading="lazy">
                    <span
                        class="absolute top-3.5 right-3.5 bg-badge text-badge-text text-[11px] font-bold tracking-[0.07em] px-3 py-1 rounded-full">
                        TÓPICO 03
                    </span>
                </div>
                <div class="flex flex-col gap-3 px-6 pt-[22px] pb-[26px] w-full">
                    <h2 class="text-text-primary text-[18px] font-semibold leading-snug m-0">
                        3. Diferença entre localhost e 192.168.x.x?
                    </h2>
                    <div class="border-l-2 border-cyan pl-4 py-1 w-full">
                        <p class="text-text-secondary text-[13px] leading-relaxed m-0">
                            <code
                                class="font-mono text-[0.88em] bg-[#192540] text-cyan px-1.5 py-px rounded-[3px]">localhost</code>
                            (127.0.0.1) é o loopback interno da própria máquina; já o endereço <code
                                class="font-mono text-[0.88em] bg-[#192540] text-cyan px-1.5 py-px rounded-[3px]">192.168.x.x</code>
                            é a identidade da interface física na rede local, visível para outros nós.
                        </p>
                    </div>
                </div>
            </article>

            <!-- Tópico 04 — Barreiras LAN -->
            <article
                class="group col-span-2 max-lg:col-span-2 max-sm:col-span-1 bg-surface rounded-[10px] overflow-hidden flex flex-col transition-all duration-250 ease-out hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(0,0,0,0.4)]">
                <div class="relative w-full h-40 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?w=600&q=80"
                        alt="Firewall e segurança de rede"
                        class="w-full h-full object-cover grayscale opacity-75 transition-[opacity,filter] duration-300 ease-[ease] group-hover:opacity-90 group-hover:grayscale-[0.5]"
                        loading="lazy">
                    <span
                        class="absolute top-3.5 right-3.5 bg-badge text-badge-text text-[11px] font-bold tracking-[0.07em] px-3 py-1 rounded-full">
                        TÓPICO 04
                    </span>
                </div>
                <div class="flex flex-col gap-3 px-6 pt-[22px] pb-[26px] w-full">
                    <h2 class="text-text-primary text-[18px] font-semibold leading-snug m-0">
                        4. O que pode impedir o acesso LAN?
                    </h2>
                    <div class="border-l-2 border-cyan pl-4 py-1 w-full">
                        <p class="text-text-secondary text-[13px] leading-relaxed m-0">
                            Geralmente o Windows Firewall bloqueia as portas 80/443 por padrão, ou configurações de
                            isolamento de cliente (AP isolation) no roteador impedem a comunicação entre dispositivos.
                        </p>
                    </div>
                </div>
            </article>

            <!-- Tópico 05 — Testar -->
            <article
                class="group col-span-2 max-lg:col-span-2 max-sm:col-span-1 bg-surface rounded-[10px] overflow-hidden flex flex-col transition-all duration-250 ease-out hover:-translate-y-1 hover:shadow-[0_12px_40px_rgba(0,0,0,0.4)]">
                <div class="relative w-full h-40 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=600&q=80"
                        alt="Teste de conectividade num segundo PC"
                        class="w-full h-full object-cover grayscale opacity-75 transition-[opacity,filter] duration-300 ease-[ease] group-hover:opacity-90 group-hover:grayscale-[0.5]"
                        loading="lazy">
                    <span
                        class="absolute top-3.5 right-3.5 bg-badge text-badge-text text-[11px] font-bold tracking-[0.07em] px-3 py-1 rounded-full">
                        TÓPICO 05
                    </span>
                </div>
                <div class="flex flex-col gap-3 px-6 pt-[22px] pb-[26px] w-full">
                    <h2 class="text-text-primary text-[18px] font-semibold leading-snug m-0">
                        5. Como testar num segundo PC da sala?
                    </h2>
                    <div class="border-l-2 border-cyan pl-4 py-1 w-full">
                        <p class="text-text-secondary text-[13px] leading-relaxed m-0">
                            Assegure que ambos estão no mesmo Wi-Fi/LAN, descubra o IP do host (servidor) e digite esse
                            IP diretamente no navegador do segundo PC. Se não carregar, revise as regras de firewall.
                        </p>
                    </div>
                </div>
            </article>

        </div>
    </main>





</body>

</html>