<main class="flex flex-col justify-center items-center w-full min-h-screen">

    <div
        class="fixed top-0 z-[-2] h-screen w-screen rotate-180 transform bg-white bg-[radial-gradient(60%_120%_at_50%_50%,hsla(0,0%,100%,0)_0,rgba(88,194,111,0.903)_100%)]">
    </div>

    <div class="flex flex-col  justify-center max-w-screen-lg relative gap-5">

        <img src="./OJS.svg" class="w-[200px] h-[150px] -ml-10 -mt-10" />

        <h1 class="text-5xl font-black text-pretty">OJS MIGRATOR</h1>

        <p class="text-2xl max-w-prose">
            Aplicacion para migrar la información de versiones de ojs 2.x a versiones de ojs 3.x
        </p>

        <div>
            <x-navigation :current="0">
                <x-link href="/issues">Empezar a migrar</x-link>
            </x-navigation>
        </div>

    </div>
</main>