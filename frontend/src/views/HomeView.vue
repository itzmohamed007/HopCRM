<template>
  <ContactDisplayModal @closeDisplayModal="displayContactModal = false" :contact="contact" v-if="displayContactModal" />
  <ContactCreateModal @requestCreateContact="handleCreateRequest" @closeCreateModal="displayCreateModal = false"
    v-if="displayCreateModal" />
  <ContactUpdateModal :contact="contact" v-if="displayUpdateModal" @closeUpdateModal="displayUpdateModal = false" />
  <DeleteAlertModal @deleteContact="handleDelete()" @closeDeleteModal="displayDeleteModal = false"
    v-if="displayDeleteModal" />
  <DuplicateAlertModal @validateDuplicateAlertModal="handleValidDuplicateAlertMOdal()"
    @closeDuplicateAlertModal="handleDuplicateAlertModal" v-if="displayDuplicateModal" />
  <div class="w-full h-screen bg-gray-100 p-5 overflow-x-hidden">
    <div class="flex items-center justify-start w-full">
      <h1 class="text-3xl font-medium text-black">Liste des contacts</h1>
    </div>
    <div class="flex items-center justify-between w-full mt-5">
      <input type="search"
        class="outline-none border border-gray-300 bg-white p-2 rounded-md w-1/3 shadow-sm focus:border-gray-400"
        placeholder="Recherche...">
      <button @click="displayCreateModal = true"
        class="border border-black font-normal text-white px-6 py-1 bg-customCyan rounded-md flex items-center gap-3"><span
          class="text-2xl">+</span>Ajouter</button>
    </div>
    <div class="mt-4 flex flex-col">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="w-3/6 px-3 py-3.5 text-left text-sm font-normal text-gray-500">NOM D'UN CONTACT
                  </th>
                  <th scope="col" class="w-3/6 px-3 py-3.5 text-left text-sm font-normal text-gray-500">SOCIETE</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-normal text-gray-500">STATUS</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-normal text-gray-500"></th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="contact in contacts" :key="contact">
                  <td class="text-start whitespace-nowrap px-3 py-4 text-sm font-semibold text-gray-600">{{
                    contact.prenom + ' ' + contact.nom
                  }}</td>
                  <td class="text-start whitespace-nowrap px-3 py-4 text-sm font-semibold text-gray-800">{{
                    contact.organisation.nom
                    }}</td>
                  <td class="text-start whitespace-nowrap px-3 py-4 text-xs font-semibold text-gray-500">
                    <span class="px-3 py-1 rounded-full"
                      :class="renderStatusBackgroundColor(contact.organisation.statut)">{{
                        contact.organisation.statut }}</span>
                  </td>
                  <td class="text-start whitespace-nowrap px-10 py-4 text-sm text-gray-500 flex items-center gap-2">
                    <Icon class="cursor-pointer text-gray-500" icon="fa-regular:eye" @click="displayContact(contact)" />
                    <Icon class="cursor-pointer text-gray-500" icon="mingcute:pencil-line"
                      @click="displayUpdate(contact)" :width="17" />
                    <Icon class="cursor-pointer text-red-400" icon="material-symbols:delete-outline" :width="17"
                      @click="displayDelete(contact)" />
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <PaginationComponent @update="handlePageChangement" :totalPages="totalPages" :currentPage="currentPage"
      :resultsPerPage="resultsPerPage" :totalResults="totalResults" />
  </div>
</template>

<script>
import PaginationComponent from '@/components/PaginationComponent.vue';
import DuplicateAlertModal from '@/components/DuplicateAlertModal.vue'
import DeleteAlertModal from '@/components/DeleteAlertModal.vue'
import ContactDisplayModal from '@/components/ContactDisplayModal.vue'
import ContactCreateModal from '@/components/ContactCreateModal.vue'
import ContactUpdateModal from '@/components/ContactUpdateModal.vue'
import { Icon } from '@iconify/vue';
import axios from '@/axios.js'
export default {
  name: 'HomeView',
  components: {
    Icon,
    PaginationComponent,
    DuplicateAlertModal,
    DeleteAlertModal,
    ContactDisplayModal,
    ContactCreateModal,
    ContactUpdateModal
  },
  data() {
    return {
      displayDeleteModal: false,
      displayDuplicateModal: false,
      displayContactModal: false,
      displayCreateModal: false,
      displayUpdateModal: false,
      contacts: [],
      contact: {},
      totalPages: 0,
      currentPage: 0,
      resultsPerPage: 0,
      totalResults: 0
    }
  },
  created() {
    this.fetch(this.currentPage);
  },
  methods: {
    async fetch(page) {
      try {
        const response = await axios.get(`/contacts?page=${page}`);
        this.contacts = response.data.data;
        this.totalPages = response.data.meta.last_page
        this.totalResults = response.data.meta.total;
        this.resultsPerPage = response.data.meta.per_page
        this.currentPage = response.data.meta.current_page;
      } catch (error) {
        console.log('an error occured while fetching contacts');
        console.log(error)
      }
    },
    async create() {
      try {
        this.errors = []
        const response = await axios.post('/contacts', this.contact);
        if (response.status == 201) {
          this.displayCreateModal = false;
          this.fetch(this.currentPage);
        }
      } catch (error) {
        this.errors = []
        Object.keys(error.response.data.errors).forEach(key => {
          this.errors.push(error.response.data.errors[key][0])
        })
        this.displayErrorsBox = true
        console.log('an error occured while create a contact')
        console.log(error)
      }
    },
    async checkForDuplicates() {
      const contactDuplicate = await this.checkContactDuplicate();
      const organisationDuplicate = await this.checkOrganisationDuplicate();
      if (contactDuplicate || organisationDuplicate) {
        this.displayCreateModal = false;
        this.displayDuplicateModal = true;
      } else this.create();
    },
    async checkContactDuplicate() {
      try {
        const response = await axios.post('/contacts/duplicate', {
          'nom': this.contact.nom,
          'prenom': this.contact.prenom
        });
        return response.data;
      } catch (error) {
        console.log('an error occured while searching for contact duplicate');
        console.log(error);
      }
    },
    async checkOrganisationDuplicate() {
      try {
        const response = await axios.post('/organisations/duplicate', {
          'nom': this.contact.organisation.nom
        });
        return response.data;
      } catch (error) {
        console.log('an error occured while searching for organisation duplicate');
        console.log(error);
      }
    },
    async handleDelete() {
      try {
        console.log(this.contact)
        await axios.delete('/contacts', {
          data: this.contact
        });
        this.displayDeleteModal = false;
        if (this.contacts.length == 1)
          this.fetch(this.currentPage - 1)
        else
          this.fetch(this.currentPage)
      } catch (error) {
        console.log('an error occured while deleting contact')
        console.log(error)
      }
    },
    handleValidDuplicateAlertMOdal() {
      this.displayDuplicateModal = false;
      this.create();
    },
    handleDuplicateAlertModal() {
      this.displayDuplicateModal = false
    },
    handleCreateRequest(contact) {
      this.contact = contact
      this.checkForDuplicates();
    },
    displayDelete(contact) {
      this.contact = contact;
      this.displayDeleteModal = true;
    },
    displayUpdate(contact) {
      this.contact = contact
      this.displayUpdateModal = true
    },
    displayContact(contact) {
      this.contact = contact;
      this.displayContactModal = true
    },
    handlePageChangement(page) {
      this.currentPage = page;
      this.fetch(page)
    },
    renderStatusBackgroundColor(status) {
      switch (status) {
        case "LEAD":
          return "bg-blue-300";
        case "CLIENT":
          return "bg-green-200";
        case "PROSPECT":
          return "bg-orange-200";
        default:
          return "bg-gray-300";
      }
    }
  },
}
</script>
