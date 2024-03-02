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
                <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                <path d="M7 8h10" />
                <path d="M7 12h10" />
                <path d="M7 16h10" />
            </svg>

            <h1 class="text-5xl font-black text-pretty">Migrar articulos</h1>

            <p class="text-2xl max-w-prose">
                Migrar toda la información de los articulos de ojs 2.x a ojs 3.x.
                <br>
                Que hace:
                Obtiene la información de la base de datos con ojs 2.x y la inserta en la base de datos con ojs 3.x.
            </p>

        </div>

        <div class="flex max-w-md flex-col items-start gap-y-4">
            Que tablas utiliza:

            <x-table
                :body="[ [ 'published_articles', 'submissions, publications'], ['articles', 'submissions, publications' ], ['article_settings', 'publication_settings'], ['article_galleys', 'publication_galleys'], ['files', 'files, submission_files, submission_file_settings'] ]" />
        </div>

        @if (isset($total) && !is_null($total))
        <x-success :total="$total" />
        @endif

        <div>
            <form wire:submit="migrar">
                <x-navigation :current="2">
                    <x-submit>Migrar</x-submit>
                </x-navigation>
            </form>
        </div>

        <div class="dark" wire:loading>
            <x-loading />
        </div>
    </div>
</main>