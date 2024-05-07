<script setup lang="ts">
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectManufacturer from '@/Components/SelectManufacturer.vue';
import ProductList from '@/Components/ProductList.vue';
import { Head, useForm } from '@inertiajs/vue3';

type Product = {
    id: number;
    name: string;
    producer: string;
    product_id: number;
    actual: boolean | null;
    price_unit: string;
    weight: number | null;
    diameter: number | null;
    length: number | null;
    width: number | null;
    height: number | null;
    thickness: number | null;
    packaging_type: string | null;
    purchase_units: number | null;
    unit_name: string | null;
    created_at: string;
    updated_at: string;
}

const form = useForm({
    searchQuery: '',
    manufacturer: '',
});

const searchResults = ref<Product[]>([]);

async function submit() {
    form.post(route('search-products'), {
        onSuccess: (page) => {
            if (Array.isArray(page.props.products)) {
                searchResults.value = page.props.products as Product[];
            }
        },
        onError: (errors) => {
            console.error(errors);
        }
    });
}
</script>

<template>
    <Head title="Product Search" />

    <AuthenticatedLayout>
        <Head title="Product Search" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Wyszukiwanie Produktów</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="searchQuery" class="block text-sm font-medium text-gray-700">Nazwa produktu</label>
                                <TextInput id="searchQuery" class="w-full mt-1" v-model="form.searchQuery" />
                            </div>

                            <div>
                                <label for="manufacturer" class="block text-sm font-medium text-gray-700">Producent</label>
                                <SelectManufacturer id="manufacturer" class="w-full mt-1" v-model="form.manufacturer" />
                            </div>

                            <div class="flex items-end">
                                <button @click="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Search
                                </button>
                            </div>
                        </div>
                        <ProductList :products="searchResults" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>