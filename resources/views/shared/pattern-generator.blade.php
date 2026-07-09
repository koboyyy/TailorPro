<script>
    window.PatternGenerator = {
        generateSVG: function(activeType, selectedCustomer, strokeColor = '#4A3A2A', leaderColor = '#8C7A6B') {
            let svgHTML = '';

            if (activeType === 'KEMEJA' || activeType === 'BAJU') {
                function buatTeksUkuran(teks, x, y, rotasi = 0) {
                    return `<text x="${x}" y="${y}" font-family="sans-serif" font-size="14" font-weight="600" fill="#4b5563" text-anchor="middle" dominant-baseline="middle" transform="rotate(${rotasi}, ${x}, ${y})">${teks}</text>`;
                }

                function gambarPolaBajuKemeja() {
                    const PB = parseInt(selectedCustomer.p_baju) || 70;
                    const LB = parseInt(selectedCustomer.l_badan || selectedCustomer.l_dada) || 100;
                    const LBa = parseInt(selectedCustomer.l_punggung)
                        ? parseInt(selectedCustomer.l_punggung) / 2
                        : parseInt(selectedCustomer.l_bahu) / 2 || 24;

                    const skala = 10;
                    const padX = 80;
                    const padY = 100;
                    const pt = (x, y) => ({ x: padX + x * skala, y: padY + y * skala });

                    const A = { x: 0, y: 0 };
                    const F = { x: 0, y: -3 };
                    const A1 = { x: 0, y: 6 };
                    const C = { x: 0, y: A1.y + LB / 4 };
                    const D = { x: 0, y: PB };
                    const A2 = { x: 7, y: 0 };
                    const B = { x: 7 + (LBa - 7), y: 6 };
                    const E = { x: 7, y: -6 };
                    const G = { x: B.x, y: B.y - 6 };
                    const C1_belakang = { x: LB / 4 + 5, y: C.y };
                    const C1_depan = { x: C1_belakang.x + 2, y: C.y };
                    const D1_belakang = { x: C1_belakang.x, y: PB };
                    const D1_depan = { x: C1_depan.x, y: PB };

                    const maxLebar = pt(C1_depan.x, 0).x + 60;
                    const maxTinggi = pt(0, D.y).y + 60;

                    let svg = `<svg viewBox="0 0 ${maxLebar} ${maxTinggi}" class="w-full md:w-[45%] lg:w-[30%] bg-white shadow border border-gray-200 rounded-lg" style="height: auto; aspect-ratio: ${maxLebar}/${maxTinggi};">`;

                    svg += `<path d="M ${pt(F.x, F.y).x} ${pt(F.x, F.y).y} C ${pt(F.x + 3.5, F.y).x} ${pt(F.x + 3.5, F.y).y}, ${pt(E.x, E.y + 1.5).x} ${pt(E.x, E.y + 1.5).y}, ${pt(E.x, E.y).x} ${pt(E.x, E.y).y} L ${pt(G.x, G.y).x} ${pt(G.x, G.y).y} C ${pt(G.x, G.y + (C1_belakang.y - G.y) * 0.5).x} ${pt(G.x, G.y + (C1_belakang.y - G.y) * 0.5).y}, ${pt(C1_belakang.x - 5, C1_belakang.y).x} ${pt(C1_belakang.x - 5, C1_belakang.y).y}, ${pt(C1_belakang.x, C1_belakang.y).x} ${pt(C1_belakang.x, C1_belakang.y).y} L ${pt(D1_belakang.x, D1_belakang.y).x} ${pt(D1_belakang.x, D1_belakang.y).y} L ${pt(D.x, D.y).x} ${pt(D.x, D.y).y} Z" fill="#fecaca" fill-opacity="0.5" stroke="#ef4444" stroke-width="2" />`;
                    svg += `<path d="M ${pt(A1.x, A1.y).x} ${pt(A1.x, A1.y).y} C ${pt(A1.x + 3.5, A1.y).x} ${pt(A1.x + 3.5, A1.y).y}, ${pt(A2.x, A2.y + 3.5).x} ${pt(A2.x, A2.y + 3.5).y}, ${pt(A2.x, A2.y).x} ${pt(A2.x, A2.y).y} L ${pt(B.x, B.y).x} ${pt(B.x, B.y).y} C ${pt(B.x, B.y + (C1_depan.y - B.y) * 0.5).x} ${pt(B.x, B.y + (C1_depan.y - B.y) * 0.5).y}, ${pt(C1_depan.x - 7, C1_depan.y).x} ${pt(C1_depan.x - 7, C1_depan.y).y}, ${pt(C1_depan.x, C1_depan.y).x} ${pt(C1_depan.x, C1_depan.y).y} L ${pt(D1_depan.x, D1_depan.y).x} ${pt(D1_depan.x, D1_depan.y).y} L ${pt(D.x, D.y).x} ${pt(D.x, D.y).y} Z" fill="#bfdbfe" fill-opacity="0.6" stroke="#2563eb" stroke-width="2.5" />`;

                    const garisBantu = [
                        { from: F, to: D },
                        { from: A, to: A2 },
                        { from: A1, to: B },
                        { from: C, to: C1_depan },
                        { from: A2, to: E },
                        { from: B, to: G },
                    ];
                    garisBantu.forEach((g) => {
                        svg += `<line x1="${pt(g.from.x, g.from.y).x}" y1="${pt(g.from.x, g.from.y).y}" x2="${pt(g.to.x, g.to.y).x}" y2="${pt(g.to.x, g.to.y).y}" stroke="#6b7280" stroke-dasharray="5,5" />`;
                    });

                    const labelTitik = [
                        { id: 'A', pt: A, offsetX: -20, offsetY: 5 },
                        { id: 'F', pt: F, offsetX: -20, offsetY: 5 },
                        { id: 'A1', pt: A1, offsetX: -25, offsetY: 5 },
                        { id: 'A2', pt: A2, offsetX: 10, offsetY: 15 },
                        { id: 'E', pt: E, offsetX: -5, offsetY: -15 },
                        { id: 'B', pt: B, offsetX: -15, offsetY: -5 },
                        { id: 'G', pt: G, offsetX: 10, offsetY: -5 },
                        { id: 'C', pt: C, offsetX: -20, offsetY: 5 },
                        { id: 'C1', pt: C1_depan, offsetX: 15, offsetY: 5 },
                        { id: 'D', pt: D, offsetX: -20, offsetY: 5 },
                        { id: 'D1', pt: D1_depan, offsetX: 15, offsetY: 5 },
                    ];
                    labelTitik.forEach((l) => {
                        const p = pt(l.pt.x, l.pt.y);
                        svg += `<circle cx="${p.x}" cy="${p.y}" r="4" fill="#1f2937" /><text x="${p.x + l.offsetX}" y="${p.y + l.offsetY}" font-family="sans-serif" font-size="16" font-weight="bold" fill="#111827">${l.id}</text>`;
                    });

                    svg += buatTeksUkuran('3cm', pt(F.x + 1, F.y + 1.5).x, pt(F.x + 1, F.y + 1.5).y);
                    svg += buatTeksUkuran('6cm', pt(A.x + 1, A.y + 3).x, pt(A.x + 1, A.y + 3).y);
                    svg += buatTeksUkuran('6cm', pt(A2.x + 1, E.y + 3).x, pt(A2.x + 1, E.y + 3).y);
                    svg += buatTeksUkuran('6cm', pt(B.x - 1.5, G.y + 3).x, pt(B.x - 1.5, G.y + 3).y);
                    svg += buatTeksUkuran('2cm', pt(C1_belakang.x + 1, C.y - 1).x, pt(C1_belakang.x + 1, C.y - 1).y);
                    svg += buatTeksUkuran('1cm', pt(B.x + 2, B.y + (C1_belakang.y - B.y) / 2).x, pt(B.x + 2, B.y + (C1_belakang.y - B.y) / 2).y);

                    svg += `</svg>`;
                    svgHTML += svg;
                }

                function gambarPolaLenganKemeja() {
                    const panjangLengan = parseInt(selectedCustomer.p_lengan) || 60;
                    const lingkarLengan = parseInt(selectedCustomer.l_lengan) || 40;
                    const skala = 10;
                    const padX = 80;
                    const padY = 60;

                    const A = { x: padX, y: padY };
                    const C = { x: padX, y: 10 * skala + padY };
                    const B = { x: padX, y: panjangLengan * skala + padY };
                    const jarakCE = lingkarLengan / 2 + 5;
                    const E = { x: jarakCE * skala + padX, y: 10 * skala + padY };
                    const D = { x: 20 * skala + padX, y: panjangLengan * skala + padY };
                    const cp1 = { x: A.x + (E.x - A.x) * 0.35, y: A.y - 3 * skala };
                    const cp2 = { x: A.x + (E.x - A.x) * 0.65, y: E.y + 2 * skala };

                    const maxLebar = Math.max(E.x, D.x) + padX + 40;
                    const maxTinggi = B.y + padY + 40;

                    let svgUtuh = `<svg viewBox="0 0 ${maxLebar} ${maxTinggi}" class="w-full md:w-[45%] lg:w-[30%] bg-white shadow border border-gray-200 rounded-lg" style="height: auto; aspect-ratio: ${maxLebar}/${maxTinggi};">
                        <path d="M ${A.x} ${A.y} C ${cp1.x} ${cp1.y}, ${cp2.x} ${cp2.y}, ${E.x} ${E.y} L ${D.x} ${D.y} L ${B.x} ${B.y} Z" fill="#bfdbfe" fill-opacity="0.6" stroke="#2563eb" stroke-width="2.5" />
                        <line x1="${A.x}" y1="${A.y}" x2="${C.x}" y2="${C.y}" stroke="#6b7280" stroke-dasharray="5,5" />
                        <line x1="${C.x}" y1="${C.y}" x2="${E.x}" y2="${E.y}" stroke="#6b7280" stroke-dasharray="5,5" />
                        ${buatTeksUkuran('10 cm', A.x - 15, (A.y + C.y) / 2, -90)}
                        ${buatTeksUkuran(panjangLengan + ' cm', A.x - 45, (A.y + B.y) / 2, -90)}
                        ${buatTeksUkuran(jarakCE + ' cm', (C.x + E.x) / 2, C.y + 15, 0)}
                        ${buatTeksUkuran('20 cm', (B.x + D.x) / 2, B.y + 20, 0)}
                    `;

                    const buatLabel = (huruf, x, y, geserX, geserY) =>
                        `<circle cx="${x}" cy="${y}" r="5" fill="#111827" /><text x="${x + geserX}" y="${y + geserY}" font-family="sans-serif" font-size="18" font-weight="bold" fill="#111827">${huruf}</text>`;
                    svgUtuh +=
                        buatLabel('A', A.x, A.y, -25, 5) +
                        buatLabel('C', C.x, C.y, -25, 5) +
                        buatLabel('B', B.x, B.y, -25, 5) +
                        buatLabel('E', E.x, E.y, 15, 5) +
                        buatLabel('D', D.x, D.y, 15, 5) +
                        `</svg>`;
                    svgHTML += svgUtuh;
                }

                function gambarPolaKerahKemeja() {
                    const LK = selectedCustomer.lingkar_kerah || selectedCustomer.l_leher || 40;
                    const LK2 = LK / 2;
                    const skala = 15;
                    const padX = 80;
                    const padY = 60;
                    const pt = (x, y) => ({ x: padX + x * skala, y: padY + y * skala });

                    const D1 = { x: 0, y: 0 };
                    const A1 = { x: 2, y: 7 };
                    const B1 = { x: LK2, y: 7 };
                    const C1 = { x: LK2, y: 3 };
                    const gapY = 10;
                    const D = { x: 2, y: gapY };
                    const C = { x: LK2, y: gapY };
                    const B = { x: LK2, y: gapY + 3.5 };
                    const A = { x: 0, y: gapY + 2 };

                    const maxLebar = pt(LK2, 0).x + 60;
                    const maxTinggi = pt(0, B.y).y + 60;

                    let svg = `<svg viewBox="0 0 ${maxLebar} ${maxTinggi}" class="w-full md:w-[45%] lg:w-[30%] bg-white shadow border border-gray-200 rounded-lg" style="height: auto; aspect-ratio: ${maxLebar}/${maxTinggi};">`;
                    svg += `<path d="M ${pt(D1.x, D1.y).x} ${pt(D1.x, D1.y).y} C ${pt(LK2 * 0.3, 1.5).x} ${pt(LK2 * 0.3, 1.5).y}, ${pt(LK2 * 0.7, C1.y).x} ${pt(LK2 * 0.7, C1.y).y}, ${pt(C1.x, C1.y).x} ${pt(C1.x, C1.y).y} L ${pt(B1.x, B1.y).x} ${pt(B1.x, B1.y).y} L ${pt(A1.x, A1.y).x} ${pt(A1.x, A1.y).y} L ${pt(D1.x, D1.y).x} ${pt(D1.x, D1.y).y} Z" fill="#bfdbfe" fill-opacity="0.6" stroke="#2563eb" stroke-width="2.5" />`;
                    svg += `<path d="M ${pt(D.x, D.y).x} ${pt(D.x, D.y).y} C ${pt(2 + LK2 * 0.3, D.y + 0.5).x} ${pt(2 + LK2 * 0.3, D.y + 0.5).y}, ${pt(LK2 * 0.7, C.y + 0.5).x} ${pt(LK2 * 0.7, C.y + 0.5).y}, ${pt(C.x, C.y).x} ${pt(C.x, C.y).y} L ${pt(B.x, B.y).x} ${pt(B.x, B.y).y} C ${pt(LK2 * 0.5, B.y).x} ${pt(LK2 * 0.5, B.y).y}, ${pt(3, B.y).x} ${pt(3, B.y).y}, ${pt(A.x, A.y).x} ${pt(A.x, A.y).y} C ${pt(0, gapY + 0.5).x} ${pt(0, gapY + 0.5).y}, ${pt(1, D.y).x} ${pt(1, D.y).y}, ${pt(D.x, D.y).x} ${pt(D.x, D.y).y} Z" fill="#fecaca" fill-opacity="0.6" stroke="#ef4444" stroke-width="2" />`;

                    const garisBantu = [
                        { from: { x: 0, y: -2 }, to: { x: 0, y: B.y + 2 } },
                        { from: { x: 2, y: D1.y }, to: { x: 2, y: B.y + 2 } },
                        { from: { x: LK2, y: -2 }, to: { x: LK2, y: B.y + 2 } },
                    ];
                    garisBantu.forEach((g) => {
                        svg += `<line x1="${pt(g.from.x, g.from.y).x}" y1="${pt(g.from.x, g.from.y).y}" x2="${pt(g.to.x, g.to.y).x}" y2="${pt(g.to.x, g.to.y).y}" stroke="#6b7280" stroke-dasharray="5,5" />`;
                    });

                    const labelTitik = [
                        { id: 'D1', pt: D1, offsetX: -25, offsetY: 0 },
                        { id: 'A1', pt: A1, offsetX: 10, offsetY: 15 },
                        { id: 'C1', pt: C1, offsetX: 15, offsetY: -5 },
                        { id: 'B1', pt: B1, offsetX: 15, offsetY: 10 },
                        { id: 'A', pt: A, offsetX: -20, offsetY: 5 },
                        { id: 'D', pt: D, offsetX: 10, offsetY: -10 },
                        { id: 'C', pt: C, offsetX: 15, offsetY: -5 },
                        { id: 'B', pt: B, offsetX: 15, offsetY: 5 },
                    ];
                    labelTitik.forEach((l) => {
                        const p = pt(l.pt.x, l.pt.y);
                        svg += `<circle cx="${p.x}" cy="${p.y}" r="3" fill="#1f2937" /><text x="${p.x + l.offsetX}" y="${p.y + l.offsetY}" font-family="sans-serif" font-size="16" font-weight="bold" fill="#111827">${l.id}</text>`;
                    });

                    svg += buatTeksUkuran('7 cm', pt(0, A1.y / 2).x - 20, pt(0, A1.y / 2).y, -90);
                    svg += buatTeksUkuran('2 cm', pt(1, A1.y).x, pt(1, A1.y).y + 25);
                    svg += buatTeksUkuran('4 cm', pt(C1.x, C1.y + 2).x + 25, pt(C1.x, C1.y + 2).y, -90);
                    svg += buatTeksUkuran('3.5 cm', pt(C.x, C.y + 1.75).x + 30, pt(C.x, C.y + 1.75).y, -90);

                    svg += `</svg>`;
                    svgHTML += svg;
                }

                gambarPolaBajuKemeja();
                gambarPolaLenganKemeja();
                gambarPolaKerahKemeja();

            } else if (activeType === 'CELANA') {
                const pinggang = selectedCustomer.l_pinggang !== '-' ? selectedCustomer.l_pinggang : 80;
                const panjang = selectedCustomer.p_celana !== '-' ? selectedCustomer.p_celana : 95;

                svgHTML = `
                <svg width="100%" height="100%" viewBox="0 0 600 450" fill="none" stroke="${strokeColor}" stroke-width="2" xmlns="http://www.w3.org/2000/svg" class="w-full md:w-[45%] lg:w-[30%] bg-white shadow border border-gray-200 rounded-lg">
                    <path d="M 230,60 L 370,60 L 380,130 L 340,410 L 295,410 L 300,180 L 290,180 L 255,410 L 210,410 L 220,130 Z" />
                    <line x1="230" y1="80" x2="370" y2="80" stroke-dasharray="3,3" />
                    <path d="M 300,80 L 300,140 L 290,150" />
                    <path d="M 230,100 L 250,130" />
                    <path d="M 370,100 L 350,130" />

                    <!-- Dimension Pinggang -->
                    <line x1="230" y1="50" x2="370" y2="50" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="230" cy="50" r="3.5" fill="${leaderColor}" />
                    <circle cx="370" cy="50" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="272" y="35" width="56" height="30">
                        <div xmlns="http://www.w3.org/1999/xhtml" style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center;">${pinggang} cm</div>
                    </foreignObject>

                    <!-- Dimension Panjang -->
                    <line x1="180" y1="60" x2="180" y2="410" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="180" cy="60" r="3.5" fill="${leaderColor}" />
                    <circle cx="180" cy="410" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="152" y="220" width="56" height="30">
                        <div xmlns="http://www.w3.org/1999/xhtml" style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center;">${panjang} cm</div>
                    </foreignObject>
                </svg>`;
            } else if (activeType === 'ROK') {
                const pinggang = selectedCustomer.l_pinggang !== '-' ? selectedCustomer.l_pinggang : 68;
                const panjang = selectedCustomer.p_rok !== '-' ? selectedCustomer.p_rok : 65;

                svgHTML = `
                <svg width="100%" height="100%" viewBox="0 0 600 450" fill="none" stroke="${strokeColor}" stroke-width="2" xmlns="http://www.w3.org/2000/svg" class="w-full md:w-[45%] lg:w-[30%] bg-white shadow border border-gray-200 rounded-lg">
                    <path d="M 250,70 L 350,70 L 390,390 L 210,390 Z" />
                    <line x1="250" y1="95" x2="350" y2="95" stroke-dasharray="3,3" />
                    <line x1="280" y1="95" x2="280" y2="120" />
                    <line x1="320" y1="95" x2="320" y2="120" />

                    <!-- Dimension Pinggang -->
                    <line x1="250" y1="60" x2="350" y2="60" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="250" cy="60" r="3.5" fill="${leaderColor}" />
                    <circle cx="350" cy="60" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="272" y="45" width="56" height="30">
                        <div xmlns="http://www.w3.org/1999/xhtml" style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center;">${pinggang} cm</div>
                    </foreignObject>

                    <!-- Dimension Panjang -->
                    <line x1="180" y1="70" x2="180" y2="390" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="180" cy="70" r="3.5" fill="${leaderColor}" />
                    <circle cx="180" cy="390" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="152" y="210" width="56" height="30">
                        <div xmlns="http://www.w3.org/1999/xhtml" style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center;">${panjang} cm</div>
                    </foreignObject>
                </svg>`;
            } else if (activeType === 'GAMIS') {
                const dada = selectedCustomer.l_dada;
                const panjang = 135;

                svgHTML = `
                <svg width="100%" height="100%" viewBox="0 0 600 450" fill="none" stroke="${strokeColor}" stroke-width="2" xmlns="http://www.w3.org/2000/svg" class="w-full md:w-[45%] lg:w-[30%] bg-white shadow border border-gray-200 rounded-lg">
                    <path d="M 240,50 L 360,50 L 340,70 L 450,110 L 415,160 L 360,140 L 400,410 L 200,410 L 240,140 L 185,160 L 150,110 L 260,70 Z" />
                    <path d="M 270,70 C 270,95 330,95 330,70" />
                    <path d="M 255,160 C 270,170 330,170 345,160" stroke-dasharray="3,3" />

                    <!-- Dimension Dada -->
                    <line x1="240" y1="130" x2="360" y2="130" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="240" cy="130" r="3.5" fill="${leaderColor}" />
                    <circle cx="360" cy="130" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="272" y="115" width="56" height="30">
                        <div xmlns="http://www.w3.org/1999/xhtml" style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center;">${dada} cm</div>
                    </foreignObject>

                    <!-- Dimension Panjang -->
                    <line x1="120" y1="50" x2="120" y2="410" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="120" cy="50" r="3.5" fill="${leaderColor}" />
                    <circle cx="120" cy="410" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="92" y="210" width="56" height="30">
                        <div xmlns="http://www.w3.org/1999/xhtml" style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center;">${panjang} cm</div>
                    </foreignObject>
                </svg>`;
            } else if (activeType === 'WANITA') {
                const LB = parseInt(selectedCustomer.l_badan) || 90;
                const LPg = parseInt(selectedCustomer.l_pinggang) || 72;
                const LPa = parseInt(selectedCustomer.l_pinggul) || 94;
                const lebarBahu = parseInt(selectedCustomer.l_bahu) || 38;
                const lebarDada = parseInt(selectedCustomer.l_dada) || 32;
                const pBaju = parseInt(selectedCustomer.p_baju) || 135;
                const turunPinggang = 40;
                const lingkarLengan = parseInt(selectedCustomer.l_lengan) || 44;
                const lebarLingkarLengan = lingkarLengan / 2;

                const skala = 6;
                const padX = 150;
                const padY = 50;
                const pt = (x, y) => ({ x: padX + x * skala, y: padY + y * skala });

                const Y_A = 0;
                const Y_A2 = 3;
                const Y_Leher = 8;
                const Y_H_top = Y_A2 + lebarLingkarLengan;
                const Y_A3 = Y_A2 + (lebarLingkarLengan / 2);
                const Y_H_bot = Y_A + turunPinggang;
                const Y_E = Y_H_bot + 20;
                const Y_B = pBaju;

                const X_Center = 0;
                const X_A1 = 8;
                const X_C2 = lebarBahu / 2;
                const Y_C2 = 4;
                
                const X_F2 = lebarDada / 2;
                const X_F = (LB / 4) + 2;
                const X_I = (LPg / 4) + 3 + 2;
                const X_D = (LPa / 4) + 2;
                const X_B1 = X_D;

                const A = { x: X_Center, y: Y_A };
                const A1 = { x: X_A1, y: Y_A };
                const A2 = { x: X_Center, y: Y_A2 };
                const Leher_Bawah = { x: X_Center, y: Y_Leher };
                const C2 = { x: X_C2, y: Y_C2 };
                const A3 = { x: X_Center, y: Y_A3 };
                const F2 = { x: X_F2, y: Y_A3 };
                const H_top = { x: X_Center, y: Y_H_top };
                const F = { x: X_F, y: Y_H_top };
                const H_bot = { x: X_Center, y: Y_H_bot };
                const I = { x: X_I, y: Y_H_bot };
                const E = { x: X_Center, y: Y_E };
                const D = { x: X_D, y: Y_E };
                const B = { x: X_Center, y: Y_B };
                const B1 = { x: X_B1, y: Y_B };

                const a1 = { x: X_A1, y: Y_H_bot };
                const b = { x: X_I - 5, y: Y_E };
                const a2 = { x: b.x, y: Y_H_bot };

                const dart_x = X_A1 + 2;
                const dart_y_center = Y_H_bot;
                const dart_top = { x: dart_x, y: dart_y_center - 12 };
                const dart_bot = { x: dart_x, y: dart_y_center + 12 };
                const dart_left = { x: dart_x - 1.5, y: dart_y_center };
                const dart_right = { x: dart_x + 1.5, y: dart_y_center };

                const maxLebar = pt(X_B1, 0).x + 50;
                const maxTinggi = pt(0, Y_B).y + 50;

                let svg = `<svg viewBox="0 0 ${maxLebar} ${maxTinggi}" class="w-full md:w-[60%] lg:w-[45%] bg-white shadow border border-gray-200 rounded-lg" style="height: auto; aspect-ratio: ${maxLebar}/${maxTinggi}; font-family: sans-serif;">`;

                const dashLines = [
                    { from: A, to: A1 },
                    { from: A, to: A2 },
                    { from: A1, to: a1 },
                    { from: a2, to: b },
                    { from: A3, to: F2 },
                    { from: H_top, to: F },
                    { from: H_bot, to: I },
                    { from: E, to: D }
                ];
                dashLines.forEach(g => {
                    svg += `<line x1="${pt(g.from.x, g.from.y).x}" y1="${pt(g.from.x, g.from.y).y}"
                                  x2="${pt(g.to.x, g.to.y).x}" y2="${pt(g.to.x, g.to.y).y}"
                                  stroke="#111827" stroke-dasharray="4,4" stroke-width="1.2" />`;
                });

                svg += `
                    <path d="M ${pt(Leher_Bawah.x, Leher_Bawah.y).x} ${pt(Leher_Bawah.x, Leher_Bawah.y).y}
                             Q ${pt(A2.x + 3, Leher_Bawah.y).x} ${pt(A2.x + 3, Leher_Bawah.y).y}, ${pt(A1.x, A1.y).x} ${pt(A1.x, A1.y).y}
                             L ${pt(C2.x, C2.y).x} ${pt(C2.x, C2.y).y}
                             Q ${pt(F2.x, F2.y + 5).x} ${pt(F2.x, F2.y + 5).y}, ${pt(F.x, F.y).x} ${pt(F.x, F.y).y}
                             L ${pt(I.x, I.y).x} ${pt(I.x, I.y).y}
                             Q ${pt(I.x + (D.x - I.x)/2, I.y + 10).x} ${pt(I.x + (D.x - I.x)/2, I.y + 10).y}, ${pt(D.x, D.y).x} ${pt(D.x, D.y).y}
                             L ${pt(B1.x, B1.y).x} ${pt(B1.x, B1.y).y}
                             L ${pt(B.x, B.y).x} ${pt(B.x, B.y).y}
                             L ${pt(Leher_Bawah.x, Leher_Bawah.y).x} ${pt(Leher_Bawah.x, Leher_Bawah.y).y} Z"
                          fill="#fecaca" fill-opacity="0.3" stroke="#ff0000" stroke-width="2.5" />
                `;

                svg += `<path d="M ${pt(A2.x, A2.y).x} ${pt(A2.x, A2.y).y} Q ${pt(A2.x + 4, A2.y).x} ${pt(A2.x + 4, A2.y).y}, ${pt(A1.x, A1.y).x} ${pt(A1.x, A1.y).y}" fill="none" stroke="#ff0000" stroke-width="2.5" />`;
                svg += `<line x1="${pt(A2.x, A2.y).x}" y1="${pt(A2.x, A2.y).y}" x2="${pt(Leher_Bawah.x, Leher_Bawah.y).x}" y2="${pt(Leher_Bawah.x, Leher_Bawah.y).y}" stroke="#ff0000" stroke-width="2.5" />`;

                svg += `
                    <path d="M ${pt(dart_top.x, dart_top.y).x} ${pt(dart_top.x, dart_top.y).y}
                             L ${pt(dart_right.x, dart_right.y).x} ${pt(dart_right.x, dart_right.y).y}
                             L ${pt(dart_bot.x, dart_bot.y).x} ${pt(dart_bot.x, dart_bot.y).y}
                             L ${pt(dart_left.x, dart_left.y).x} ${pt(dart_left.x, dart_left.y).y} Z"
                          fill="none" stroke="#111827" stroke-dasharray="3,3" stroke-width="1.2" />
                `;
                svg += `<line x1="${pt(dart_top.x, dart_top.y).x}" y1="${pt(dart_top.x, dart_top.y).y}" x2="${pt(dart_bot.x, dart_bot.y).x}" y2="${pt(dart_bot.x, dart_bot.y).y}" stroke="#111827" stroke-dasharray="3,3" stroke-width="1.2" />`;

                const labels = [
                    { id: 'A', pt: A, ox: -15, oy: -5 },
                    { id: 'A1', pt: A1, ox: 0, oy: -10 },
                    { id: 'A2', pt: A2, ox: -20, oy: 5 },
                    { id: 'C2', pt: C2, ox: 10, oy: -5 },
                    { id: 'A3', pt: A3, ox: -20, oy: 5 },
                    { id: 'F2', pt: F2, ox: 10, oy: 5 },
                    { id: 'H', pt: H_top, ox: -15, oy: 5 },
                    { id: 'F', pt: F, ox: 10, oy: 5 },
                    { id: 'H', pt: H_bot, ox: -15, oy: 5 },
                    { id: 'I', pt: I, ox: 15, oy: 5 },
                    { id: 'a1', pt: a1, ox: -15, oy: -5 },
                    { id: 'a2', pt: a2, ox: -5, oy: -10 },
                    { id: 'b', pt: b, ox: -5, oy: 15 },
                    { id: 'E', pt: E, ox: -15, oy: 5 },
                    { id: 'D', pt: D, ox: 15, oy: 5 },
                    { id: 'B', pt: B, ox: -15, oy: 15 },
                    { id: 'B1', pt: B1, ox: 15, oy: 15 }
                ];

                labels.forEach(l => {
                    const p = pt(l.pt.x, l.pt.y);
                    svg += `<text x="${p.x + l.ox}" y="${p.y + l.oy}" font-family="sans-serif" font-size="12" fill="#111827">${l.id}</text>`;
                });

                const textSizes = [
                    { text: '8', pt: {x: 0, y: (Y_A2 + Y_Leher)/2}, ox: 10, oy: 5 },
                    { text: '1,5', pt: dart_left, ox: -5, oy: -5 },
                    { text: '1,5', pt: dart_right, ox: 5, oy: -5 }
                ];
                textSizes.forEach(t => {
                    const p = pt(t.pt.x, t.pt.y);
                    svg += `<text x="${p.x + t.ox}" y="${p.y + t.oy}" font-size="9" fill="#111827">${t.text}</text>`;
                });

                svg += `</svg>`;
                svgHTML = svg;
            }

            return svgHTML;
        }
    };
</script>
