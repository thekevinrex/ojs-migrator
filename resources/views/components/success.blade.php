@props (['total'])


<div class="border rounded-md bg-green-500 text-white p-4 flex items-center gap-3">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
    </svg>

    Migración completada con éxito.
</div>

<div
    class=" max-w-sm relative flex flex-col w-full h-full text-gray-700 bg-white/60 shadow-md bg-clip-border rounded-xl">
    <table class="w-full text-left table-auto min-w-max">
        <thead>
            <tr>
                <th class="p-4 border-b border-blue-gray-100">
                    <p class="block font-sans text-sm antialiased font-normal leading-none ">
                        Tabla
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100">
                    <p class="block font-sans text-sm antialiased font-normal leading-none ">
                        Total
                    </p>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($total as $table => $value)
            <tr class="">
                <td class="p-4">
                    <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                        {{$table}}
                    </p>
                </td>
                <td class="p-4">
                    <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                        {{$value}}
                    </p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>