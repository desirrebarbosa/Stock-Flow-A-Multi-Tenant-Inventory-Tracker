<template>
    <h1>
        Welcome to the Manager Dashboard
    </h1>
    <button @click="logout">Logout</button>
</template>

<script setup>
    import axios from 'axios';
    import { useRouter } from 'vue-router';

    const router = useRouter();

    const logout = async() => {
        try {
            const response = await axios.post(
            'http://127.0.0.1:9000/api/logout', 
            null,
            {headers:
                {Authorization: 'Bearer ' + localStorage.getItem('auth_token')}
            });

            if (response.status === 200) {
                localStorage.removeItem('auth_token');
            }

            router.push('/login');
        } catch (error) {
            console.log(error);
        }
    }
</script>