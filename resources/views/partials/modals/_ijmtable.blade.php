<!-- IJM Table -->
<h2 class="pb-2 text-sm font-bold text-blue-700">Calcul des Indemnités Journalières de Mission</h2>
<div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="overflow-hidden">
                <table class="w-full divide-y divide-gray-300 border border-gray-400">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="px-6 py-1 text-start text-xs font-medium text-gray-600 uppercase border border-gray-400">
                                Taux
                                Journalier</th>
                            <th scope="col"
                                class="px-6 py-1 text-start text-xs font-medium text-gray-600 uppercase border border-gray-400">
                                {{ $missionOrder->bareme->pays_per_day }}</th>
                            <th scope="col"
                                class="px-6 py-1 text-start text-xs font-medium text-gray-600 uppercase border border-gray-400">
                                Nuitée (s)
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-start text-xs font-medium text-gray-600 uppercase border border-gray-400">
                                Repas</th>
                            <th scope="col"
                                class="px-6 py-1 text-start text-xs font-medium text-gray-600 uppercase border border-gray-400">
                                Total</th>
                            <th scope="col"
                                class="px-6 py-1 text-start text-xs font-medium text-gray-600 uppercase border border-gray-400">
                                Devise</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="col"
                                class="px-6 py-1 text-start text-xs font-medium text-gray-600 uppercase border border-gray-400">
                                Indemnité
                                d’hébèrgement
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-start text-xs font-medium text-gray-600 uppercase border border-gray-400">
                                {{ $missionOrder->bareme->accomodation_cost }}
                            </th>
                            <td
                                class="px-6 py-1 whitespace-nowrap text-sm text-center  font-medium text-gray-900 border border-gray-400">
                                <span class="font-bold text-red-500" id="no_remaining_accomodation">
                                    {{ $missionOrder->no_accomodation - $missionOrder->no_ded_accomodation }}</span>
                            </td>
                            <td
                                class="px-6 py-1 whitespace-nowrap text-sm font-medium text-gray-900 border border-gray-400 bg-gray-400">
                            </td>
                            <td
                                class="px-6 py-1 whitespace-nowrap text-sm font-medium text-gray-900 border border-gray-400">
                                <span id="value_remaining_accomodation">
                                    {{ ($missionOrder->no_accomodation - $missionOrder->no_ded_accomodation) * $missionOrder->bareme->accomodation_cost }}</span>
                            </td>
                            <td
                                class="px-6 py-1 whitespace-nowrap text-sm font-medium text-gray-900 border border-gray-400">
                                {{ $missionOrder->bareme->currency }}</td>
                        </tr>
                        <tr>
                            <th scope="col"
                                class="px-6 py-1 text-start text-xs font-medium text-gray-600 uppercase border border-gray-400">
                                Indemnité de
                                Repas
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-start text-xs font-medium text-gray-600 uppercase border border-gray-400">
                                {{ $missionOrder->bareme->meal_cost }}
                            </th>
                            <td
                                class="px-6 py-1 whitespace-nowrap text-sm font-medium text-gray-900 border border-gray-400 bg-gray-400">
                            </td>
                            <td
                                class="px-6 py-1 whitespace-nowrap text-sm text-center  font-medium text-gray-900 border border-gray-400">
                                <span class="font-bold text-red-500" id="no_remaining_meals">
                                    {{ $missionOrder->no_meals - $missionOrder->no_ded_meals }}</span>
                            </td>
                            <td
                                class="px-6 py-1 whitespace-nowrap text-sm font-medium text-gray-900 border border-gray-400">
                                <span id="value_remaining_meals">
                                    {{ ($missionOrder->no_meals - $missionOrder->no_ded_meals) * $missionOrder->bareme->meal_cost }}</span>
                            </td>
                            <td
                                class="px-6 py-1 whitespace-nowrap text-sm font-medium text-gray-900 border border-gray-400">
                                {{ $missionOrder->bareme->currency }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <th scope="col" colspan="2"
                                class="px-6 py-1 text-center text-xs font-bold text-blue-600 uppercase border border-gray-500">
                                Total
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-start text-xs font-bold text-blue-600 uppercase border border-gray-500">
                                <span id="total">
                                    {{ ($missionOrder->no_accomodation - $missionOrder->no_ded_accomodation) *
                                        $missionOrder->bareme->accomodation_cost +
                                        ($missionOrder->no_meals - $missionOrder->no_ded_meals) * $missionOrder->bareme->meal_cost }}</span>
                                <input type="hidden" name="total_amount" id="total_hidden"
                                    value="{{ ($missionOrder->no_accomodation - $missionOrder->no_ded_accomodation) *
                                        $missionOrder->bareme->accomodation_cost +
                                        ($missionOrder->no_meals - $missionOrder->no_ded_meals) * $missionOrder->bareme->meal_cost }}">
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-start text-xs font-bold text-blue-600 uppercase border border-gray-500">
                                {{ $missionOrder->bareme->currency }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
                <script>
                    document.getElementById('no_remaining_accomodation').textContent = {{ $missionOrder->no_accomodation }} - document
                        .getElementById('no_ded_accomodation').value;
                    document.getElementById('value_remaining_accomodation').textContent = ({{ $missionOrder->no_accomodation }} -
                        document.getElementById('no_ded_accomodation').value) * {{ $missionOrder->bareme->accomodation_cost }};
                    document.getElementById('no_remaining_meals').textContent = {{ $missionOrder->no_meals }} - document
                        .getElementById('no_ded_meals').value;
                    document.getElementById('value_remaining_meals').textContent = ({{ $missionOrder->no_meals }} - document
                        .getElementById('no_ded_meals').value) * {{ $missionOrder->bareme->meal_cost }};
                    document.getElementById('total').textContent = ({{ $missionOrder->no_accomodation }} - document.getElementById(
                            'no_ded_accomodation').value) * {{ $missionOrder->bareme->accomodation_cost }} + (
                            {{ $missionOrder->no_meals }} - document.getElementById('no_ded_meals').value) *
                        {{ $missionOrder->bareme->meal_cost }};
                    document.getElementById('total_hidden').value = ({{ $missionOrder->no_accomodation }} - document.getElementById(
                            'no_ded_accomodation').value) * {{ $missionOrder->bareme->accomodation_cost }} + (
                            {{ $missionOrder->no_meals }} - document.getElementById('no_ded_meals').value) *
                        {{ $missionOrder->bareme->meal_cost }};

                    document.getElementById('no_ded_accomodation').addEventListener('input', function() {
                        document.getElementById('no_remaining_accomodation').textContent =
                            {{ $missionOrder->no_accomodation }} - this.value;
                        document.getElementById('value_remaining_accomodation').textContent = (
                                {{ $missionOrder->no_accomodation }} - document.getElementById('no_ded_accomodation').value) *
                            {{ $missionOrder->bareme->accomodation_cost }};
                        document.getElementById('total').textContent = ({{ $missionOrder->no_accomodation }} - document
                                .getElementById('no_ded_accomodation').value) *
                            {{ $missionOrder->bareme->accomodation_cost }} + ({{ $missionOrder->no_meals }} - document
                                .getElementById('no_ded_meals').value) * {{ $missionOrder->bareme->meal_cost }};
                        document.getElementById('total_hidden').value = ({{ $missionOrder->no_accomodation }} - document
                                .getElementById('no_ded_accomodation').value) *
                            {{ $missionOrder->bareme->accomodation_cost }} + ({{ $missionOrder->no_meals }} - document
                                .getElementById('no_ded_meals').value) * {{ $missionOrder->bareme->meal_cost }};
                    });
                    document.getElementById('no_ded_meals').addEventListener('input', function() {
                        document.getElementById('no_remaining_meals').textContent = {{ $missionOrder->no_meals }} - this.value;
                        document.getElementById('value_remaining_meals').textContent = ({{ $missionOrder->no_meals }} -
                            document.getElementById('no_ded_meals').value) * {{ $missionOrder->bareme->meal_cost }};
                        document.getElementById('total').textContent = ({{ $missionOrder->no_accomodation }} - document
                                .getElementById('no_ded_accomodation').value) *
                            {{ $missionOrder->bareme->accomodation_cost }} + ({{ $missionOrder->no_meals }} - document
                                .getElementById('no_ded_meals').value) * {{ $missionOrder->bareme->meal_cost }};
                        document.getElementById('total_hidden').value = ({{ $missionOrder->no_accomodation }} - document
                                .getElementById('no_ded_accomodation').value) *
                            {{ $missionOrder->bareme->accomodation_cost }} + ({{ $missionOrder->no_meals }} - document
                                .getElementById('no_ded_meals').value) * {{ $missionOrder->bareme->meal_cost }};
                    });
                </script>
            </div>
        </div>
    </div>
</div>
