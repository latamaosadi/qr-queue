<template>
    <div>
        <div class="text-center mb-2">
            <button
                @click="refreshQueue()"
                class="bg-blue-500 text-white px-4 py-2 text-sm rounded hover:shadow-lg focus:shadow-outline active:bg-blue-700 transitions duration-300"
            ><i class="fas fa-sync mr-2"></i>Refresh Antrian</button>
        </div>
        <div class="flex -m-2 mx-auto">
            <div class="p-2 flex-1">
                <div class="rounded-lg bg-gray-100 border-2 border-gray-800 shadow-lg text-center p-6">
                    <h1 class="text-2xl">Antrian Menunggu</h1>
                    <h4 class="text-4xl font-bold">{{ stats.inline }}</h4>
                </div>
            </div>
            <div class="p-2 flex-1">
                <div class="rounded-lg bg-gray-100 border-2 border-green-500 text-green-500 shadow-lg text-center p-6">
                    <h1 class="text-2xl">Peserta Dilayani</h1>
                    <h4 class="text-4xl font-bold">{{ stats.done }}</h4>
                </div>
            </div>
            <div class="p-2 flex-1">
                <div class="rounded-lg bg-gray-100 border-2 border-red-500 text-red-500 shadow-lg text-center p-6">
                    <h1 class="text-2xl">Peserta Belum Terproses</h1>
                    <h4 class="text-4xl font-bold">{{ stats.absent }}</h4>
                </div>
            </div>
        </div>
        <div class="p-4 text-center mt-6" v-if="(step === 'idle') && (stats.inline > 0)">
            <button
                @click="processQueue()"
                :disabled="loading"
                :class="{'spinner-sm': loading}"
                class="bg-blue-500 py-4 px-6 text-white rounded font-bold hover:bg-blue-700 hover:shadow-xl transition duration-300"
            >Proses Antrian</button>
        </div>
        <div
            v-else-if="customer"
            class="mt-6"
        >
            <h1 class="text-center text-2xl">Antrian <span class="font-bold font-mono">{{ customer.readable_queue }}</span></h1>
            <div
                v-if="step === 'handling'"
                class="text-4xl text-center text-green-500 font-bold font-mono"
            >
                {{ formatedInterviewDuration }}
            </div>
            <div class="max-w-lg mx-auto mt-4 text-xl bg-gray-200 p-4 rounded-md">
                <div class="w-32 mx-auto">
                    <div class="pb-full overflow-hidden rounded-full bg-gray-300 relative">
                        <img :src="customer.profile.avatar" alt="" class="absolute inset-0 h-full w-full object-cover">
                    </div>
                </div>
                <div class="mt-6">
                    <div class="-m-1">
                        <div class="p-1 flex">
                            <div class="w-1/3 text-right pr-4 font-bold">Nama:</div>
                            <div class="w-2/3">{{ customer.profile.nama }}</div>
                        </div>
                        <div class="p-1 flex">
                            <div class="w-1/3 text-right pr-4 font-bold">Tanggal Lahir:</div>
                            <div class="w-2/3">{{ customer.profile.tanggal_lahir }}</div>
                        </div>
                        <div class="p-1 flex">
                            <div class="w-1/3 text-right pr-4 font-bold">NIK:</div>
                            <div class="w-2/3">{{ formatNIK(customer.profile.nik) }}</div>
                        </div>
                        <div class="p-1 flex">
                            <div class="w-1/3 text-right pr-4 font-bold">Program:</div>
                            <div class="w-2/3">{{ customer.profile.program }}</div>
                        </div>
                        <div class="p-1 flex">
                            <div class="w-1/3 text-right pr-4 font-bold">No HP:</div>
                            <div class="w-2/3">{{ customer.profile.no_hp }}</div>
                        </div>
                        <div class="p-1 flex">
                            <div class="w-1/3 text-right pr-4 font-bold">Email:</div>
                            <div class="w-2/3">{{ customer.profile.email }}</div>
                        </div>
                        <div class="p-1 flex">
                            <div class="w-1/3 text-right pr-4 font-bold">Alamat:</div>
                            <div class="w-2/3">{{ customer.profile.alamat }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="flex justify-center mt-6" v-if="step === 'calling'">
            <button
                @click="confirmQueue()"
                :disabled="loading"
                :class="{'spinner-sm': loading}"
                class="bg-green-500 py-4 px-6 text-white rounded font-bold hover:bg-green-700 hover:shadow-xl transition duration-300"
            >Konfirmasi Antrian</button>
            <button
                @click="skipQueue()"
                :disabled="loading"
                :class="{'spinner-sm': loading}"
                class="bg-red-500 py-4 px-6 text-white rounded font-bold hover:bg-red-700 hover:shadow-xl transition duration-300 ml-6"
            >Lewati Antrian</button>
            <button
                v-if="stats.inline > 0"
                @click="skipQueue(true)"
                :disabled="loading"
                :class="{'spinner-sm': loading}"
                class="bg-red-500 py-4 px-6 text-white rounded font-bold hover:bg-red-700 hover:shadow-xl transition duration-300 ml-6"
            >Lewati Antrian & Proses Baru</button>
        </div>
        <div class="flex justify-center mt-6" v-if="step === 'handling'">
            <button
                @click="finishQueue()"
                :disabled="loading"
                :class="{'spinner-sm': loading}"
                class="bg-blue-500 py-4 px-6 text-white rounded font-bold hover:bg-blue-700 hover:shadow-xl transition duration-300"
            >Selesai</button>
            <button
                v-if="stats.inline > 0"
                @click="finishQueue(true)"
                :disabled="loading"
                :class="{'spinner-sm': loading}"
                class="bg-green-500 py-4 px-6 text-white rounded font-bold hover:bg-green-700 hover:shadow-xl transition duration-300 ml-6"
            >Selesai & Ambil Antrian Baru</button>
        </div>
    </div>
</template>

<!-- script js -->
<script src="./Queue.js"></script>
