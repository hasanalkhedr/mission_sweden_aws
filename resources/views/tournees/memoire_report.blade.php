@extends('layouts.app')
@section('title', $tournee->order_number . '-' . $tournee->employee->first_name . ' ' . $tournee->employee->last_name)
@section('content')

<div id="report-content" class="scale-content">
        <div class="report-page" style="width: 210mm; height: 297mm; margin: 0 auto; padding: 2mm 8mm; box-sizing: border-box;">
            <!-- Header -->
            <div class="flex justify-between items-start mb-[2px]">
                <x-application-logo class="h-12 w-2/5" />
                <div class="text-right w-3/5">
                    <p>Stockholm, {{ $tournee->memor_date->format('d/m/Y') }}</p>
                </div>
            </div>
            <!-- Title -->
            <h1 class="text-2xl font-bold text-center mb-[2px]">MÉMOIRE DE FRAIS</h1>
            <table class="table-auto w-full text-left">
                <thead>
                    <tr class="bg-blue-200">
                        <th colspan="4" class="px-4">Tournee</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="w-1/3">Identité du tourneeaire :</td>
                        <td colspan="3" class="w-2/3">{{ $tournee->employee->first_name }}
                            {{ $tournee->employee->last_name }}, {{ $tournee->employee->position }}</td>
                    </tr>
                    <tr>
                        <td class="w-1/3">Ordre de tournee {{ $tournee->order_date->format('Y') }}
                        </td>
                        <td colspan="3" class="w-2/3">{{ $tournee->order_number }}</td>
                    </tr>
                    <tr>
                        <td class="w-1/3">Objet de la tournee :</td>
                        <td colspan="3" class="w-2/3">{{ $tournee->purpose }}</td>
                    </tr>
                    <tr>
                        <td class="w-1/4">Lieu de la tournee :</td>
                        <td class="w-1/4">{{ $tournee->arrive_location }}</td>
                        <td class="w-1/4">Pays :</td>
                        <td class="w-1/4">{{ $tournee->bareme->pays }}</td>
                    </tr>
                    <tr>
                        <td class="w-1/4">Date d'arrivée :</td>
                        <td class="w-1/4">{{ $tournee->start_date->format('d/m/Y') }}</td>
                        <td class="w-1/4">Heure d'arrivée :</td>
                        <td class="w-1/4">{{ $tournee->start_time }}</td>
                    </tr>
                    <tr>
                        <td class="w-1/4">Date de départ :</td>
                        <td class="w-1/4">{{ $tournee->end_date->format('d/m/Y') }}</td>
                        <td class="w-1/4">Heure de départ :</td>
                        <td class="w-1/4">{{ $tournee->end_time }}</td>
                    </tr>
                    <tr class="bg-gray-200 h-4">
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td class="w-1/4">Nuitées à déduire des IJM :</td>
                        <td class="w-1/4">{{ $tournee->no_ded_accomodation }}</td>
                        <td class="w-1/4">Repas à déduire :</td>
                        <td class="w-1/4">{{ $tournee->no_ded_meals }}</td>
                    </tr>
                    <tr>
                        <td class="w-1/4">Avance sur IJM (USD ou EURO) :</td>
                        <td class="w-1/4">{{ $tournee->advance }}</td>
                        <td class="w-1/4">Restau adm. :</td>
                        <td class="w-1/4">0</td>
                    </tr>
                </tbody>
            </table>
            <table class="table-auto w-full text-left px-2">
                <thead>
                    <tr class="bg-blue-200">
                        <th colspan="2" class="px-4">Calcul des Indemnités Journalières de Tournee</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="w-full px-[2px]">
                            @include('partials.modals._tournee-ijmtable')
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table-auto w-full text-left">
                <thead>
                    <tr class="bg-blue-200">
                        <th class="px-4">Remboursement de frais de transport et frais divers sur justificatifs</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="w-full">
                            <div class="flex flex-col">
                                <div class="-m-1.5 overflow-x-auto">
                                    <div class="p-[2px] min-w-full inline-block align-middle">
                                        <div class="overflow-hidden">
                                            <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"
                                                            class="px-1 py-[1px] text-center text-xs font-medium text-gray-500 uppercase">
                                                            Nature de
                                                            la dépense</th>
                                                        <th scope="col"
                                                            class="px-1 py-[1px] text-center text-xs font-medium text-gray-500 uppercase">
                                                            Date
                                                            dépense</th>
                                                        <th scope="col"
                                                            class="px-1 py-[1px] text-center text-xs font-medium text-gray-500 uppercase">
                                                            Montant</th>
                                                        <th scope="col"
                                                            class="px-1 py-[1px] text-center text-xs font-medium text-gray-500 uppercase">
                                                            Devise</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($tournee->expenses as $expense)
                                                        <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                                            <td
                                                                class="px-1 text-center border border-gray-200 py-[1px] whitespace-nowrap text-sm font-medium text-gray-800">
                                                                {{ $expense->description }}</td>
                                                            <td
                                                                class="px-1 text-center border border-gray-200 py-[1px] whitespace-nowrap text-sm text-gray-800">
                                                                {{ $expense->expense_dateformat('d/m/Y H:i') }}</td>
                                                            <td
                                                                class="px-1 text-center border border-gray-200 py-[1px] whitespace-nowrap text-sm text-gray-800">
                                                                {{ $expense->amount }}</td>
                                                            <td
                                                                class="px-1 text-center border border-gray-200 py-[1px] whitespace-nowrap text-sm text-gray-800">
                                                                {{ $expense->currency }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                                            <td colspan="4"
                                                                class="px-1 text-center border border-gray-200 py-[1px] whitespace-nowrap text-sm font-medium text-gray-800">
                                                                {{ __('No Expenses Found') }}</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                                <tfoot>
                                                    @forelse ($tournee->getExpensesByCurrency() as $currency=>$currencyAmount)
                                                        <tr>
                                                            <th scope="col"></th>
                                                            <th scope="col"
                                                                class="px-1 py-[1px] text-center text-xs font-bold text-blue-600 uppercase border border-gray-500">
                                                                SOMME
                                                            </th>
                                                            <th scope="col"
                                                                class="px-1 py-[1px] text-center text-xs font-bold text-blue-600 uppercase border border-gray-500">
                                                                {{ $currencyAmount }}
                                                            </th>
                                                            <th scope="col"
                                                                class="px-1 py-[1px] text-center text-xs font-bold text-blue-600 uppercase border border-gray-500">
                                                                {{ $currency }}
                                                            </th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table-auto w-full text-left">
                <thead>
                    <tr class="bg-blue-200">
                        <th colspan="2" class="px-4">Montant total du remboursement (IJM + FRAIS DIVERS - AVANCE)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="w-full py-1" colspan="2">
                            <table class="border border-gray-500 table-auto text-center">
                                <tr>
                                    <td rowspan="2" class="w-1/3 border border-gray-500">Totaux</td>
                                    <td class="border border-gray-500 w-2/12">IJM</td>
                                    <td class="border border-gray-500 w-2/12">Frais divers</td>
                                    <td class="border border-gray-500 w-2/12">Avance</td>
                                    <td class="border border-gray-500 w-2/12">Net à payer</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-500 w-2/12">{{ $tournee->total_amount }}</td>
                                    <td class="border border-gray-500 w-2/12">
                                        <ul>
                                            @forelse ($tournee->getExpensesByCurrency() as $currency=>$currencyAmount)
                                                <li>{{ $currencyAmount }} {{ $currency }}</li>
                                            @empty
                                                <li>0.00</li>
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td class="border border-gray-500 w-2/12">{{ $tournee->advance }}</td>
                                    <td class="border border-gray-500 w-2/12">
                                        <ul>
                                            @forelse ($tournee->getMemoireTotals() as $currency=>$currencyAmount)
                                                <li>{{ $currencyAmount }} {{ $currency }}</li>
                                            @empty
                                                <li>0.00</li>
                                            @endforelse
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </td>
                </tbody>
            </table>
            <table class="table-auto w-full text-left">
                @if (count($tournee->getMemoireTotals()) === 1)
                    <tr>
                        <td class="w-2/5 py-[1px]">ARRETE ET LIQUIDE LA SOMME DE:</td>
                        @foreach ($tournee->getMemoireTotals() as $currency => $currencyAmount)
                            <td class="w-3/5 py-[1px]">{{ $currencyAmount }} {{ $currency }} <span
                                    class="font-normal px-5"> arrondi à </span>{{ round($currencyAmount) }}
                                {{ $currency }}</td>
                        @endforeach
                    </tr>
                @else
                    @foreach ($tournee->getMemoireTotals() as $currency => $currencyAmount)
                        @if ($loop->first)
                            <tr>
                                <td class="w-2/5 py-[1px]" rowspan="{{ count($tournee->getMemoireTotals()) }}">
                                    ARRETE ET LIQUIDE LA SOMME DE :</td>
                                <td class="w-3/5 py-[1px]">{{ $currencyAmount }} {{ $currency }} <span
                                        class="font-normal px-5">
                                        arrondi à </span>{{ round($currencyAmount) }}
                                    {{ $currency }}</td>
                            </tr>
                        @else
                            <tr>
                                <td class="w-3/5 py-[1px]">{{ $currencyAmount }} {{ $currency }} <span
                                        class="font-normal px-5">
                                        arrondi à </span>{{ round($currencyAmount) }}
                                    {{ $currency }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            </table>
            <table class="table-auto w-full text-left">
                <thead>
                    <tr class="bg-blue-200">
                        <th class="px-4 w-5/12">Signature du bénéficiaire</th>
                        <th class="px-12 w-7/12">Signature de l'autorité compétente</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="w-6/12">
                            <span>Atteste l'effectitivité des dépenses exposées</span>
                        </td>
                        <td class="w-6/12 text-center">
                            <span>Certifié exact,</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="w-6/12 pb-3">
                            <span>ci-dessus, en demande le remboursement,</span>
                        </td>
                        <td class="w-6/12 text-center">
                            <span></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="w-5/12">
                            <span></span>
                        </td>
                        <td class="w-7/12 text-center">
                            <span class="font-bold text-lg w-24 text-center">Katerina Doytchinov</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="w-5/12">
                            <span class="font-light text-md  w-16 text-center">
                                {{ $tournee->employee->first_name }} {{ $tournee->employee->last_name }},
                                {{ $tournee->employee->position }}
                            </span>
                        </td>
                        <td class="w-7/12 text-center">
                            <span class="font-light text-md  w-16 text-center">COCAC - Directrice de l'IFS</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Action Buttons -->
    <div class="flex justify-center space-x-4 mb-8 no-print">
        <button onclick="window.print()"
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-200 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                </path>
            </svg>
            {{ __('Print Report') }}
        </button>
        <button id="download-pdf"
            class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-200 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
            </svg>
            {{ __('Save as PDF file') }}
        </button>
    </div>
    <style>
        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
                margin: 0 !important;
                padding: 0 !important;
                background: white !important;
            }

            .report-page {
                width: 190mm !important;
                height: 277mm !important;
                margin: 10mm auto !important;
                page-break-after: avoid;
                page-break-inside: avoid;
            }

            .no-print {
                display: none !important;
            }
            .scale-content {
                transform-origin: top left;
                width: 100%;
                height: 100%;
            }
        }


        /* Screen styles */
        .report-page {
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0;
        }

        .report-page {
            overflow: hidden;
            /* Prevent any hidden overflow */
        }

        .btn-blue {
            background: #2563eb;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .btn-green {
            background: #059669;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
    </style>

    <script>
        document.getElementById("download-pdf").addEventListener("click", async function() {
            var element = document.getElementById('report-content'); // The element you want to print
            const loading = createLoadingIndicator();

            try {
                await generatePDF(element);
            } catch (error) {
                alert("Failed to generate PDF. Please try printing instead (Ctrl+P).");
                alert(error);
            } finally {
                loading.remove();
            }
        });

        function createLoadingIndicator() {
            const loading = document.createElement('div');
            loading.style.position = 'fixed';
            loading.style.top = '0';
            loading.style.left = '0';
            loading.style.width = '100%';
            loading.style.height = '100%';
            loading.style.backgroundColor = 'rgba(0,0,0,0.7)';
            loading.style.color = 'white';
            loading.style.display = 'flex';
            loading.style.flexDirection = 'column';
            loading.style.justifyContent = 'center';
            loading.style.alignItems = 'center';
            loading.style.zIndex = '9999';
            loading.innerHTML = `
            <div style="font-size: 24px; margin-bottom: 20px;">Generating PDF...</div>
            <div style="width: 50%; height: 20px; background: #555; border-radius: 10px;">
                <div id="progress-bar" style="width: 0%; height: 100%; background: #4CAF50; border-radius: 10px;"></div>
            </div>
            <p id="progress-text" style="margin-top: 10px;">Initializing...</p>
        `;
            document.body.appendChild(loading);
            return loading;
        }

        function updateProgress(percentage, message) {
            const progressBar = document.getElementById('progress-bar');
            const progressText = document.getElementById('progress-text');
            if (progressBar) progressBar.style.width = percentage + '%';
            if (progressText) progressText.textContent = message;
        }

        async function generatePDF(element, customOptions = {}) {
    try {
        updateProgress(10, "Preparing content...");

        // First get the height of the content
        const contentHeight = element.scrollHeight;
        const pageHeight = 277 * 3.78; // 277mm in pixels (approx)

        // Calculate scale factor if content is taller than page
        let scale = 1;
        if (contentHeight > pageHeight) {
            scale = pageHeight / contentHeight * 0.95; // 95% to add some margin
        }

        const defaultOptions = {
            margin: 0,
            filename: `Mémoire-{{ $tournee->order_number }}-{{ $tournee->employee->first_name }}_{{ $tournee->employee->last_name }}.pdf`,
            html2canvas: {
                scale: 2,
                useCORS: true,
                windowHeight: element.scrollHeight,
                onclone: (clonedDoc) => {
                    // Apply scaling to the cloned document
                    const reportContent = clonedDoc.getElementById('report-content');
                    if (reportContent) {
                        reportContent.style.transform = `scale(${scale})`;
                        reportContent.style.width = `${100/scale}%`;
                        reportContent.style.height = `${100/scale}%`;
                    }
                }
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait',
            }
        };

        const options = {
            ...defaultOptions,
            ...customOptions
        };

        updateProgress(30, "Generating PDF...");

        await new Promise((resolve, reject) => {
            html2pdf()
                .set(options)
                .from(element)
                .save()
                .then(() => {
                    updateProgress(90, "Finalizing PDF...");
                    setTimeout(() => {
                        updateProgress(100, "Done!");
                        resolve();
                    }, 500);
                })
                .catch(reject);
        });
    } catch (error) {
        console.error("PDF generation failed:", error);
        updateProgress(0, "Failed to generate PDF");
        throw error;
    }
}
    </script>
@endsection
