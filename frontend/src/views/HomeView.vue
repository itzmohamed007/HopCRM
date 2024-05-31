<template>
  <div class="w-full h-screen bg-gray-100 p-5 overflow-x-hidden">
    <div class="flex items-center justify-start w-full">
      <h1 class="text-3xl font-medium text-black">Liste des contacts</h1>
    </div>
    <div class="flex items-center justify-between w-full mt-5">
      <input type="search"
        class="outline-none border border-gray-300 bg-white p-2 rounded-md w-1/3 shadow-sm focus:border-gray-400"
        placeholder="Recherche...">
      <button
        class="border border-black font-normal text-white px-8 py-2 bg-customCyan rounded-md flex items-center gap-3"><span
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
                    <Icon class="cursor-pointer text-gray-500" icon="fa-regular:eye" />
                    <Icon class="cursor-pointer text-gray-500" icon="mingcute:pencil-line" :width="17" />
                    <Icon class="cursor-pointer text-red-400" icon="material-symbols:delete-outline" :width="17" />
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-5 flex items-start justify-between w-full">
      <p class="text-gray-600 text-xs font-normal">Showing <span class="font-semibold">1</span> of <span
          class="font-semibold">{{ totalPages }}</span> of <span class="font-semibold">{{ totalResults }}</span> results</p>
      <PaginationComponent @update="handlePageChangement" :totalPages="totalPages" :currentPage="currentPage" :resultsPerPage="resultsPerPage"
        :totalResults="totalResults" />
    </div>
  </div>
</template>

<script>
import { Icon } from '@iconify/vue';
import PaginationComponent from '@/components/PaginationComponent.vue';
import axios from '@/axios.js'
export default {
  name: 'HomeView',
  components: {
    Icon,
    PaginationComponent
  },
  data() {
    return {
      contacts: [],
      totalPages: 0,
      currentPage: 0,
      resultsPerPage: 0,
      totalResults: 0,
      people: [
        { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', status: 'Lead' },
        { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', status: 'Lead' },
        { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', status: 'Client' },
        { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', status: 'Client' },
        { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', status: 'Prospect' },
        { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', status: 'Client' },
        { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', status: 'Lead' },
        { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', status: 'Lead' },
        { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', status: 'Lead' },
        { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', status: 'Lead' },
      ]
    }
  },
  created() {
    this.fetch(this.currentPage);
  },
  methods: {
    handlePageChangement(page) {
      this.currentPage = page;
      this.fetch(page)
    },
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
