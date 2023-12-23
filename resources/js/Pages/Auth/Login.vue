<script setup>
import {useForm} from "@inertiajs/vue3";

defineProps({
    layout: null,
});

let form = useForm({
   email: '',
   password: '',
});

let submit = () => {
    form.post('/login');
}
</script>

<template>
    <Head title="Login"/>
    <main class=" bg-gray-200 grid place-items-center min-h-screen">
        <section class="bg-white p-8 rounded-xl max-w-md mx-auto border w-full">
            <h1 class="grid place-items-center font-bold text-3xl mb-6">Login</h1>
            <form @submit.prevent="submit" class="mt-7">
                <div class="mb-6">
                    <label for="email" class="block mb-2 uppercase text-xs text-gray-700">
                        Email
                    </label>
                    <input
                        v-model="form.email"
                        type="email"
                        name="email"
                        id="email"
                        class="border border-gray-400 rounded p-2 w-full"
                        required
                    >
                    <div v-if="form.errors.email"
                         v-text="form.errors.email"
                         class="text-red-500 text-sm mt-2"
                    ></div>
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 uppercase text-xs text-gray-700">
                        Password
                    </label>
                    <input
                        v-model="form.password"
                        type="password"
                        name="password"
                        id="password"
                        class="border border-gray-400 rounded p-2 w-full"
                        required
                    >
                    <div v-if="form.errors.password"
                         v-text="form.errors.password"
                         class="text-red-500 text-sm mt-2"
                    ></div>
                </div>

                <div class="grid place-items-end">
                    <button type="submit"
                            class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                            :disabled="form.processing"
                    >Login</button>
                </div>
            </form>
        </section>
    </main>
</template>
