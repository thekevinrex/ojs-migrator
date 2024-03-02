<main class="flex flex-col justify-center items-center w-full min-h-screen">

    <div
        class="fixed top-0 z-[-2] h-screen w-screen rotate-180 transform bg-white bg-[radial-gradient(60%_120%_at_50%_50%,hsla(0,0%,100%,0)_0,rgba(88,194,111,0.903)_100%)]">
    </div>

    <div class="flex flex-col  justify-center max-w-screen-lg relative gap-5 pt-52 mb-24">

        <div class="space-y-3 relative">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="size-[350px] z-[-1] absolute -left-[180px] text-slate-700 -top-[130px] opacity-40" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
            </svg>

            <h1 class="text-5xl font-black text-pretty">Migrar autores</h1>

            <p class="text-2xl max-w-prose">
                Migrar toda la información de los autores de ojs 2.x a ojs 3.x.
                <br>
                Que hace:
                Obtiene la información de la base de datos con ojs 2.x y la inserta en la base de datos con ojs 3.x.
            </p>

        </div>

        <div class="flex max-w-sm flex-col items-start gap-y-4">
            Que tablas utiliza:

            <x-table :body="[ ['authors', 'authors'], ['author_settings', 'author_settings'] ]" />
        </div>

        @if (isset($total) && !is_null($total))
        <x-success :total="$total" />
        @endif

        <div>
            <form wire:submit="migrar">

                <x-navigation :current="3">
                    <x-submit>Migrar</x-submit>
                </x-navigation>
            </form>
        </div>

        <div class="dark" wire:loading>
            <x-loading />
        </div>
    </div>
</main>