<template>
    <form @submit.prevent="login">
        <input v-model="email" placeholder="Enter your email"/>
        <input v-model = "password" placeholder="Enter your password"/>
        <button type="submit">Login</button>
    </form>
</template>

<script setup>
    import { ref } from 'vue';
    import axios from 'axios';
    import { useRouter } from 'vue-router' 

    const email = ref('');
    const password = ref('');
    const router = useRouter();

    const login = async () => {
        try {
             const response = await axios.post('http://127.0.0.1:9000/api/login', {
                email: email.value,
                password: password.value

            });

            let the_extracted_token = response.data.token;
            localStorage.setItem('auth_token', the_extracted_token);

            router.push('/dashboard');
        
        } catch (error) {
            console.log(error);
        }
    }
</script>