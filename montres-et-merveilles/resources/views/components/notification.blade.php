<div id="notifContainer"
    class="fixed bg-green-100 bottom-8 left-8 z-10 rounded-md min-w-96 bg-opacity-80 backdrop-blur-md shadow-md">
    <div class="relative flex flex-col">
        <div class="flex flex-col py-2.5 px-4 gap-2">
            <div class="flex justify-between">
                <h2 class="text-green-900 font-bold text-lg">{!! $title !!}</h2>
                <span title="Fermer la notification" id="notifRemoveBtn" class="cursor-pointer">&#10005;</span>
            </div>

            <span class="text-green-950">{!! $content !!}</span>
        </div>
        <span id="notif-cooldown" class="flex flex-1 min-h-1.5 bg-green-900 rounded-b-md"></span>
    </div>
</div>

<script defer>
    const notifContainer = document.getElementById("notifContainer");
    const removeBtn = document.getElementById("notifRemoveBtn");

    removeBtn.addEventListener('click', () => {
        notifContainer.remove();
    });

    setTimeout(() => {
        notifContainer.remove();
    }, 4800);
</script>
