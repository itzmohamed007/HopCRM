<template>
    <div class="absolute w-full h-screen bg-gray-500 bg-opacity-80">
        <div class="relative top-4 left-32 w-3/5 bg-white rounded-md">
            <div class="p-5 text-start">
                <div class="flex items-center justify-start gap-5">
                    <span class="p-2 rounded-full bg-red-100 text-red-500">
                        <Icon icon="octicon:alert-16" />
                    </span>
                    <p class="text-xl font-semibold">Doublon</p>
                </div>
                <div class="py-10 px-14 text-sm font-semibold text-gray-500">
                    <p>Un contact existe dèja avec le même prenom et le même nom.</p>
                    <p>Etes-vous Sûr de vouloir ajouter ce contact ?</p>
                </div>
            </div>
            <div class="p-5 bg-gray-100 flex items-center justify-end gap-2 text-sm rounded-b-md">
                <button @click="$emit('closeDuplicateAlertModal')"
                    class="px-5 py-2 rounded-md text-gray-900 bg-gray-100 border border-gray-300">Annuler</button>
                <button @click="$emit('validateDuplicateAlertModal')"
                    class="px-5 py-2 rounded-md text-white bg-red-500 border border-gray-300">Confirmer</button>
            </div>
        </div>
    </div>
</template>

<script>
import { Icon } from '@iconify/vue';
export default {
    name: "DuplicateAlertModal",
    components: {
        Icon
    }
}
</script>