@extends('layouts.app')
@section('title', $tournee->order_number . '-' . $tournee->employee->first_name . ' ' . $tournee->employee->last_name)
@section('content')

<div id="report-content" class="scale-content">
        <div class="report-page" style="width: 210mm;  margin: 0 auto; padding: 2mm 8mm; box-sizing: border-box;">
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
                                <div class="-mx-1.5 my-0 overflow-x-auto">
                                    <div class="p-[2px] min-w-full inline-block align-middle">
                                        <div class="overflow-hidden expenses-table">
                                            <table class="w-full divide-y divide-gray-200 border mx-1 border-gray-300" style="table-layout: fixed;">
                                                <colgroup>
                                                    <col style="width: 70mm;"> <!-- Description -->
                                                    <col style="width: 40mm;"> <!-- Date -->
                                                    <col style="width: 30mm;"> <!-- Amount -->
                                                    <col style="width: 54mm;"> <!-- Currency -->
                                                </colgroup>
                                                <thead>
                                                    <tr>
                                                        <th scope="col"
                                                            class="px-1 py-[1px] text-center text-xs font-medium text-gray-500 uppercase border border-gray-200">
                                                            Nature de
                                                            la dépense</th>
                                                        <th scope="col"
                                                            class="px-1 py-[1px] text-center text-xs font-medium text-gray-500 uppercase border border-gray-200">
                                                            Date
                                                            dépense</th>
                                                        <th scope="col"
                                                            class="px-1 py-[1px] text-center text-xs font-medium text-gray-500 uppercase border border-gray-200">
                                                            Montant</th>
                                                        <th scope="col"
                                                            class="px-1 py-[1px] text-center text-xs font-medium text-gray-500 uppercase border border-gray-200">
                                                            Devise</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($tournee->expenses as $expense)
                                                        <tr class="odd:bg-white even:bg-gray-100">
                                                            <td class="px-1 py-[1px] border border-gray-200 text-sm text-gray-800 break-words align-top">
                                                                {{ $expense->description }}
                                                            </td>
                                                            <td class="px-1 py-[1px] border border-gray-200 text-sm text-gray-800 break-words align-top text-center">
                                                                {{ $expense->expense_date->format('d/m/Y H:i') }}
                                                            </td>
                                                            <td class="px-1 py-[1px] border border-gray-200 text-sm text-gray-800 break-words align-top text-right">
                                                                {{ number_format($expense->amount, 2) }}
                                                            </td>
                                                            <td class="px-1 py-[1px] border border-gray-200 text-sm text-gray-800 break-words align-top text-center">
                                                                {{ $expense->currency }}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="px-1 py-[1px] text-center border border-gray-200 text-sm font-medium text-gray-800">
                                                                {{ __('No Expenses Found') }}
                                                            </td>
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
                                    <td rowspan="2" class="w-1/5 border border-gray-500">Totaux</td>
                                    <td class="border border-gray-500 w-1/5">IJM</td>
                                    <td class="border border-gray-500 w-1/5">Frais divers</td>
                                    <td class="border border-gray-500 w-1/5">Avance</td>
                                    <td class="border border-gray-500 w-1/5">Net à payer</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-500 w-1/5">{{ $tournee->total_amount }}</td>
                                    <td class="border border-gray-500 w-1/5">
                                        <ul>
                                            @forelse ($tournee->getExpensesByCurrency() as $currency=>$currencyAmount)
                                                <li>{{ $currencyAmount }} {{ $currency }}</li>
                                            @empty
                                                <li>0.00</li>
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td class="border border-gray-500 w-1/5">{{ $tournee->advance }}</td>
                                    <td class="border border-gray-500 w-1/5">
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
        .html2pdf__page-break {
        margin: 0;
        padding: 0;
        page-break-after: always;
    }
    .html2pdf__page-break:last-child {
        page-break-after: avoid;
    }
        @media print {

            html,
            body {
                width: 210mm;
                min-height: 297mm;
                margin: 0 !important;
                padding: 0 !important;
                background: white !important;
            }
table {
        page-break-inside: auto;
    }
    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }
    td, th {
        padding: 1px 2px;
        font-size: 10pt;
    }
            .report-page {
                width: 210mm !important;
                min-height: 277mm !important;
                margin: 3mm 3mm !important;
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

/* Ensure table respects fixed layout */
.expenses-table table {
    table-layout: fixed;
    width: 100%;
    border-collapse: collapse;
}

/* Cell styling */
.expenses-table td, .expenses-table th {
    overflow: hidden;
    word-wrap: break-word;
    padding: 2px 4px;
}
/* Specific column widths */
.expenses-table col:nth-child(1) { width: 70mm; } /* Description */
.expenses-table col:nth-child(2) { width: 40mm; } /* Date */
.expenses-table col:nth-child(3) { width: 30mm; } /* Amount */
.expenses-table col:nth-child(4) { width: 54mm; } /* Currency */
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

                const defaultOptions = {
                    margin: [0, 0, 15, 0], // Top, Left, Bottom, Right (extra bottom margin for page numbers)
                    filename: `Mémoire-{{ $tournee->order_number }}-{{ $tournee->employee->first_name }}_{{ $tournee->employee->last_name }}.pdf`,
                    html2canvas: {
                        scale: 2,
                        useCORS: true,
                        allowTaint: true,
                        scrollY: 0,
                        letterRendering: true,
                        logging: false,
                    },
                    jsPDF: {
                        unit: 'mm',
                        format: 'a4',
                        orientation: 'portrait',
                        hotfixes: ['px_scaling'],
                    },
                    pagebreak: {
                        mode: ['css', 'legacy'],
                        before: '.page-break'
                    },
                };

                updateProgress(30, "Generating PDF...");

                // Generate PDF first
                const pdf = await new Promise((resolve, reject) => {
                    html2pdf()
                        .set(defaultOptions)
                        .from(element)
                        .toPdf()
                        .get('pdf')
                        .then(resolve)
                        .catch(reject);
                });

                // Now add page numbers
                const totalPages = pdf.internal.getNumberOfPages();
                for (let i = 1; i <= totalPages; i++) {
                    pdf.setPage(i);
                    pdf.setFontSize(10);
                    pdf.setTextColor(100);
                    pdf.text(
                        `Page ${i} of ${totalPages}`,
                        180,
                        pdf.internal.pageSize.getHeight() - 5,
                        { align: 'right' }
                    );
                }

                // Save the modified PDF
                pdf.save(defaultOptions.filename);

                updateProgress(100, "Done!");

            } catch (error) {
                console.error("PDF generation failed:", error);
                updateProgress(0, "Failed to generate PDF");
                throw error;
            }
        }
    </script>
@endsection
