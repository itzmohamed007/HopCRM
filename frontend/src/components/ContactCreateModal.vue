<template>
    <div class="absolute w-full h-screen bg-gray-500 bg-opacity-80 overflow-y-auto">
        <div class="relative top-4 left-32 w-3/5 bg-white rounded-md mb-10">
            <div class="text-start">
                <div class="flex items-center justify-start p-5 gap-5">
                    <p class="text-xl font-semibold">Ajouter un contact</p>
                </div>
                <form @submit.prevent>
                    <div class="p-5 space-y-4 mt-2">
                        <div class="flex space-x-4">
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-600">Prénom</label>
                                <input type="text" v-model="contact.prenom"
                                    class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-600">Nom</label>
                                <input type="text" v-model="contact.nom"
                                    class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">E-mail</label>
                            <input type="email" v-model="contact.e_mail"
                                class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Entreprise</label>
                            <input type="text" v-model="contact.organisation.nom"
                                class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Adresse</label>
                            <textarea type="text" v-model="contact.organisation.adresse"
                                class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md resize-none h-20"></textarea>
                        </div>
                        <div class="flex space-x-4">
                            <div class="w-3/12">
                                <label class="block text-sm font-medium text-gray-600">Code postal</label>
                                <input type="text" v-model="contact.organisation.code_postal"
                                    class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                            </div>
                            <div class="w-full">
                                <label class="block text-sm font-medium text-gray-600">Ville</label>
                                <input type="text" v-model="contact.organisation.ville"
                                    class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Statut</label>
                            <select v-model="contact.organisation.statut"
                                class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                                <option v-for="status in statuses" :key="status">{{ status }}</option>
                            </select>
                        </div>
                    </div>
                    <div v-if="displayErrorsBox"
                        class="flex flex-col items-start justify-center bg-red-500 text-white font-light p-5 gap-1">
                        <p v-for="error in errors" :key="error">{{ error + '\n' }}</p>
                    </div>
                    <div class="p-5 bg-gray-100 flex items-center justify-end gap-2 text-sm rounded-b-md">
                        <button @click="$emit('closeCreateModal')"
                            class="px-5 py-2 rounded-md text-gray-900 bg-gray-100 border border-gray-300">Annuler</button>
                        <button @click="create()"
                            class="px-5 py-2 rounded-md text-white bg-customCyan border border-gray-300">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: "ContactCreateModal",
    data() {
        return {
            contact: {
                organisation: {}
            },
            errors: [],
            statuses: ['LEAD', 'CLIENT', 'PROSPECT'],
            displayErrorsBox: false
        };
    },
    methods: {
        async create() {
            try {
                this.errors = []
                const response = await axios.post('/contacts', this.contact);
                if (response.status == 201)
                    this.$emit('fetch')
            } catch (error) {
                this.errors = []
                Object.keys(error.response.data.errors).forEach(key => {
                    this.errors.push(error.response.data.errors[key][0])
                })
                this.displayErrorsBox = true
                console.log('an error occured while create a contact')
                console.log(error)
            }
        }
    }
}
</script>
