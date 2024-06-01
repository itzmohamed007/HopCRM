<template>
    <div @click.self="$emit('closeDisplayModal')"
        class="absolute w-full h-screen bg-gray-500 bg-opacity-80 overflow-y-auto">
        <div class="relative top-4 left-32 w-3/5 bg-white rounded-md mb-10">
            <div class="text-start">
                <div class="flex items-center justify-start p-5 gap-5">
                    <p class="text-xl font-semibold">Modifier le contact</p>
                </div>
                <form @submit.prevent>
                    <div class="p-5 space-y-4 mt-2">
                        <div class="flex space-x-4">
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-600">Prénom</label>
                                <input v-model="localContact.prenom" type="text"
                                    class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-600">Nom</label>
                                <input v-model="localContact.nom" type="text"
                                    class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">E-mail</label>
                            <input v-model="localContact.e_mail" type="text"
                                class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Entreprise</label>
                            <input v-model="localContact.organisation.nom" type="text"
                                class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Adresse</label>
                            <textarea v-model="localContact.organisation.addresse" type="text"
                                class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md resize-none h-20"></textarea>
                        </div>
                        <div class="flex space-x-4">
                            <div class="w-3/12">
                                <label class="block text-sm font-medium text-gray-600">Code postal</label>
                                <input v-model="localContact.organisation.code_postal" type="text"
                                    class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                            </div>
                            <div class="w-full">
                                <label class="block text-sm font-medium text-gray-600">Ville</label>
                                <input v-model="localContact.organisation.ville" type="text"
                                    class="focus:border focus:border-black mt-1 px-3 py-2 text-sm w-full border border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Statut</label>
                            <select v-model="localContact.organisation.statut"
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
                        <button @click="$emit('closeUpdateModal')"
                            class="px-5 py-2 rounded-md text-gray-900 bg-gray-100 border border-gray-300">Annuler</button>
                        <button @click="update()"
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
    name: "ContactUpdateModal",
    props: {
        contact: {
            required: true
        }
    },
    data() {
        return {
            localContact: this.contact,
            statuses: ['LEAD', 'CLIENT', 'PROSPECT'],
            errors: [],
            displayErrorsBox: false
        };
    },
    methods: {
        async update() {
            this.validateDuplicateSearchInputs() // frontend validation
            this.errors.length ? this.displayErrorsBox = true : this.displayErrorsBox = false
            try {
                await axios.put('/contacts', this.localContact);
                this.$emit('updateFetch');
            } catch (error) {
                this.errors = [] // backend validation
                Object.keys(error.response.data.errors).forEach(key => {
                    this.errors.push(error.response.data.errors[key][0])
                })
                this.displayErrorsBox = true
                console.log('an error occured while updating contact')
                console.log(error)
            }
        },
        validateDuplicateSearchInputs() {
            const alphaRegex = /^[A-Za-z]+$/;
            const alphaNumRegex = /^[A-Za-z0-9]+$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const numericRegex = /^[0-9]+$/;
            const validStatut = ['LEAD', 'CLIENT', 'PROSPECT'];
            this.errors = [];

            if (!this.localContact.nom)
                this.errors.push('The nom field is required.');
            else if (!alphaRegex.test(this.localContact.nom))
                this.errors.push('The nom field must contain only alphabetic characters.');

            if (!this.localContact.prenom)
                this.errors.push('The prenom field is required.');
            else if (!alphaRegex.test(this.localContact.prenom))
                this.errors.push('The prenom field must contain only alphabetic characters.');

            if (!this.localContact.e_mail)
                this.errors.push('The e_mail field is required.');
            else if (!emailRegex.test(this.localContact.e_mail))
                this.errors.push('The e_mail field must be a valid email address.');

            if (!this.localContact.organisation.nom)
                this.errors.push('The organisation nom field is required.');
            else if (!alphaNumRegex.test(this.localContact.organisation.nom))
                this.errors.push('The organisation nom field must contain only alphabetic and numeric characters.');

            if (this.localContact.organisation.code_postal && !numericRegex.test(this.localContact.organisation.code_postal))
                this.errors.push('The organisation.code_postal field must contain only numeric characters.');

            if (this.localContact.organisation.ville && !alphaRegex.test(this.localContact.organisation.ville))
                this.errors.push('The organisation.ville field must contain only alphabetic characters.');

            if (this.localContact.organisation.statut && !validStatut.includes(this.localContact.organisation.statut))
                this.errors.push(`The organisation.statut field must be one of the following values: ${validStatut.join(', ')}.`);
        }
    }
}
</script>
