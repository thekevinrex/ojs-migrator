@props (['body'])

<div class="relative flex flex-col w-full h-full text-gray-700 bg-white/60 shadow-md bg-clip-border rounded-xl">
    <table class="w-full text-left table-auto min-w-max">
        <thead>
            <tr>
                <th class="p-4 border-b border-blue-gray-100">
                    <p class="block font-sans text-sm antialiased font-normal leading-none ">
                        Ojs 2.x
                    </p>
                </th>
                <th class="p-4 border-b border-blue-gray-100">
                    <p class="block font-sans text-sm antialiased font-normal leading-none ">
                        Ojs 3.x
                    </p>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($body as $row)
            <tr class="">
                @foreach($row as $cell)
                <td class="p-4">
                    <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                        {{$cell}}
                    </p>
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>