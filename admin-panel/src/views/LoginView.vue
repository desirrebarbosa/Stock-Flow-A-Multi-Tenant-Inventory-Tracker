<!-- <template>
    <a-typography-title :level="3" style="text-align: center;">
        Log In
    </a-typography-title>
    <a-row justify="center" align="middle" layout="vertical">
        <a-card style="width: 400px; max-width:100%;" :bodystyle="{padding: '40px'}">
            <a-form @submit.prevent="login" layout="vertical">
                <a-form-item label="Email" v-model="email" placeholder="Enter your email"/>
                <label for="password">Password: </label>
                <a-input v-model="password" type="password" placeholder="Enter your password"/>
                <a-button type="primary" block>Login</a-button>
            </a-form>
        </a-card>
    </a-row>
</template> -->

<template>
    <a-row justify="center" align="middle" style="min-height: 100vh; background-color: #f0f2f5;">
        <a-col :xs="22" :sm="16" :md="10" :lg="8" :xl="6">
            <a-card :body-style="{padding: '40px'}">
                <!-- h3 -->
                <a-typography-title :level="3" style="text-align:center; margin-bottom: 24px;">
                    Log In
                </a-typography-title>

                <!-- form -->
                <a-form layout="vertical" @submit.prevent="login">
                    <a-form-item label="Email">
                        <a-input v-model:value="email" placeholder="Enter your email" size="large">
                            <template #prefix>
                               <MailOutlined style="color: #bfbfbf;" />
                            </template>
                        </a-input>           
                    </a-form-item>
                    <a-form-item label="Password">
                        <a-input v-model:value="password" placeholder="Enter your password" size="large">
                             <template #prefix>
                               <MailOutlined style="color: #bfbfbf;" />
                            </template>
                        </a-input>
                    </a-form-item>

                    <!-- submit button -->
                    <a-form-item style="margin-top: 8px;">
                        <a-button
                            type="primary"
                            html-type="submit"
                            block
                            size="large"
                            :disabled="!isFormValid"
                        >
                            Login
                        </a-button>
                    </a-form-item>
                </a-form>
            </a-card>
        </a-col>
    </a-row>
</template>

<script setup>
    import { ref, computed } from 'vue';
    import axios from 'axios';
    import { useRouter } from 'vue-router';

    const email = ref('');
    const password = ref('');
    const router = useRouter();

    const isFormValid = computed(() => {
        return email.value.trim() !== '' && password.value.trim() !== ''
    })

    const login = async () => {
        try {
            const response = await axios.post(
                `${import.meta.env.VITE_API_BASE_URL}/login`, {
                email: email.value,
                password: password.value
            });
            let the_extracted_token = response.data.token;

            localStorage.setItem('auth_token', the_extracted_token);
            console.log("3. Token saved. Attempting to push to dashboard...");

            try {
                await router.push('/dashboard');
            } 
            catch (navError) {
            }
        
        } catch (error) {
            
            
        }
    }
</script>
