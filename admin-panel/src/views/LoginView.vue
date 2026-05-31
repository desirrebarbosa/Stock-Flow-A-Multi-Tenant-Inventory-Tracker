<template>
    <form @submit.prevent="login">
        <input v-model="email" placeholder="Enter your email"/>
        <input v-model="password" type="password" placeholder="Enter your password"/>
        <button type="submit">Login</button>
    </form>
</template>

<script setup>
    import { ref } from 'vue';
    import axios from 'axios';
    import { useRouter } from 'vue-router';

    const email = ref('');
    const password = ref('');
    const router = useRouter();

    const login = async () => {
        try {
            console.log("1. Sending login request...");
            const response = await axios.post(
                `${import.meta.env.VITE_API_BASE_URL}/login`, {
                email: email.value,
                password: password.value
            });
            
            console.log("2. Response received:", response.data);

            let the_extracted_token = response.data.token;
            
            // Check if the token actually exists where we think it does
            if (!the_extracted_token) {
                console.error("🚨 Token is missing! Check the response structure above.");
                return; // Stop execution so we don't save 'undefined'
            }

            localStorage.setItem('auth_token', the_extracted_token);
            console.log("3. Token saved. Attempting to push to dashboard...");

            // Inside your login function:
            console.log("Attempting to route to dashboard...");

            try {
                await router.push('/dashboard');
                console.log("Routing successful!");
            } catch (navError) {
                console.error("Vue Router blocked the navigation:", navError);
            }
        
        } catch (error) {
            console.error("🚨 Login failed or routing was blocked:", error);
            
        }
    }
</script>