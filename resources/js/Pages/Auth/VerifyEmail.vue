<script setup>
import { computed } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
  status: String,
});

const form = useForm();

const submit = () => {
  form.post(route("verification.send"));
};

const verificationLinkSent = computed(
  () => props.status === "verification-link-sent"
);
</script>

<template>
  <BreezeGuestLayout>
    <Head title="Email Verification" />

    <div class="mb-4 text-sm text-gray-600">
      Спасибо за регистрацию! Прежде чем начать, не могли бы вы подтвердить свою
      электронную почту адрес, нажав на ссылку, которую мы только что отправили
      вам по электронной почте? если бы ты не получите электронное письмо, мы с
      радостью вышлем вам другое.
    </div>

    <div
      class="mb-4 font-medium text-sm text-green-600"
      v-if="verificationLinkSent"
    >
      На указанный вами адрес электронной почты отправлена ​​новая ссылка для
      подтверждения Во время регистрации.
    </div>

    <form @submit.prevent="submit">
      <div class="mt-4 flex items-center justify-between">
        <BreezeButton
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Выслать повторно письмо для подтверждения
        </BreezeButton>

        <Link
          :href="route('logout')"
          method="post"
          as="button"
          class="underline text-sm text-gray-600 hover:text-gray-900"
          >Выйти</Link
        >
      </div>
    </form>
  </BreezeGuestLayout>
</template>
