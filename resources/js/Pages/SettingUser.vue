<template lang="pug">
Head(title="Настройки")

BreezeAuthenticatedLayout
  .container.mt-4.flex.justify-center
    section
      Card.relative.mb-4.rounded-xl(class="w-[30rem]")
        h3.mb-2.text-lg.font-semibold Настройки пользователя

        Form(ref="addForm", :model="form", :rules="rules")
          FormItem(label="Ваше имя")
            Input(placeholder="Имя", v-model="form.name")
          FormItem(label="Почта для получения отчетов")
            Input(placeholder="Электронная почта", v-model="form.email")
          FormItem(label="ID Телеграм для получения отчетов")
            Input(placeholder="Электронная почта", v-model="form.telegram_id")
          FormItem(label="Интервал проверки")
            Select(v-model="form.interval")
              Option(
                v-for="item in intervalList",
                :value="item.value",
                :key="item.key",
                :selected="item.value === user.interval"
              ) {{ item.label }}
          FormItem(label="Каналы получения отчетов")
            CheckboxGroup(v-model="form.checkbox")
              Checkbox(label="Почта")
              Checkbox(label="Телеграм")

          .flex.justify-end
            Button(
              type="primary",
              @click="submit",
              :disabled="form.processing"
            ) Обновить
</template>

<script setup>
import { useForm, usePage } from "@inertiajs/inertia-vue3";

const user = usePage().props.value.auth.user;

const form = useForm({
  name: user.name,
  email: user.email,
  interval: user.interval,
  telegram_id: user.telegram_id,
  checkbox: [],
});

const rules = {
  name: [{ required: true }],
  email: [{ required: true }],
};

const intervalList = [
  {
    value: 1,
    label: "1 Минуты",
  },
  {
    value: 5,
    label: "5 Минут",
  },
];

const submit = () => {
  form.put(route("setting.update", { id: user.id }));
};
</script>