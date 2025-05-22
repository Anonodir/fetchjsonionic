<template>
  <IonPage class="login-page">
    <IonContent>
      <!-- <div class="logo-container">
        <img src="logo.png" alt="Logo" class="logo" />
      </div> -->

      <div class="login-card">
        <h2 class="text-center">Login</h2>

        <IonInput label="Username" labelPlacement="floating" fill="outline"  v-model="username" />
        <br>
        <IonInput label="Password" labelPlacement="floating" fill="outline" type="password" v-model="password" />

        <IonButton expand="block" class="login-btn" @click="handleLogin">Login</IonButton>
      </div>

      <!-- Alert -->
      <IonAlert
        :is-open="showAlert"
        :header="alertHeader"
        :message="alertMessage"
        :buttons="alertButtons"
        @didDismiss="showAlert = false"
      />
    </IonContent>
  </IonPage>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import {
  IonPage,
  IonContent,
  IonInput,
  IonButton,
  IonAlert
} from '@ionic/vue';

const username = ref('');
const password = ref('');
const router = useRouter();

// Alert control
const showAlert = ref(false);
const alertHeader = ref('');
const alertMessage = ref('');
const alertButtons = ref(['OK']);

const handleLogin = async () => {
  try {
    const response = await axios.post('http://localhost/belajar-api/login.php', {
      username: username.value,
      password: password.value
    });

    console.log(response.data);

    if (response.data.status === 'succes') {
      localStorage.setItem('user', JSON.stringify(response.data.data));

      alertHeader.value = 'Login Berhasil';
      alertMessage.value = 'Selamat datang!';
      alertButtons.value = [{
        text: 'OK',
        handler: () => {
          router.push('/home'); // Navigasi setelah alert ditutup
        }
      }];
      showAlert.value = true;
    } else {
      alertHeader.value = 'Login Gagal';
      alertMessage.value = 'Username atau password salah.';
      alertButtons.value = ['OK'];
      showAlert.value = true;
    }
  } catch (error) {
    alertHeader.value = 'Error';
    alertMessage.value = 'Tidak dapat terhubung ke server.';
    alertButtons.value = ['OK'];
    showAlert.value = true;
  }
};
</script>