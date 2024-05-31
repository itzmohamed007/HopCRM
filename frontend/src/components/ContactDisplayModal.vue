<template>
    <div @click.self="$emit('closeDisplayModal')"
        class="absolute w-full h-screen bg-gray-500 bg-opacity-80 overflow-y-auto">
        <div class="relative top-4 left-32 w-3/5 bg-white rounded-md mb-10">
            <div class="text-start">
                <div class="flex items-center justify-start p-5 gap-5">
                    <p class="text-xl font-semibold">Détail du contact</p>
                </div>
                <div class="p-5 space-y-4 mt-2">
                    <div class="flex space-x-4">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-600">Prénom</label>
                            <input v-model="localContact.prenom" type="text" readonly
                                class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-600">Nom</label>
                            <input v-model="localContact.nom" type="text" readonly
                                class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">E-mail</label>
                        <input v-model="localContact.e_mail" type="text" readonly
                            class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Entreprise</label>
                        <input v-model="localContact.organisation.nom" type="text" readonly
                            class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Adresse</label>
                        <textarea v-model="localContact.organisation.addresse" type="text" readonly
                            class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md resize-none h-20"></textarea>
                    </div>
                    <div class="flex space-x-4">
                        <div class="w-3/12">
                            <label class="block text-sm font-medium text-gray-600">Code postal</label>
                            <input v-model="localContact.organisation.code_postal" type="text" readonly
                                class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                        </div>
                        <div class="w-full">
                            <label class="block text-sm font-medium text-gray-600">Ville</label>
                            <input v-model="localContact.organisation.ville" type="text" readonly
                                class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Statut</label>
                        <input v-model="localContact.organisation.statut" type="text" readonly
                            class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ContactDisplayModal",
    props: {
        contact: {
            required: true
        }
    },
    data() {
        return {
            localContact: { ...this.contact }
        };
    }
}
</script>
