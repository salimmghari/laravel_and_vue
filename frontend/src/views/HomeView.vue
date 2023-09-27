<template>
    <AppLayout>
        <AppTitle title="Notes" />
        <AppNote v-for="(note, index) in notes" :key="index" :title="note.title" :body="note.body" :onTitleChange="(event: Event) => note.title = (event.target as HTMLInputElement).value" :onBodyChange="(event: Event) => note.body = (event.target as HTMLTextAreaElement).value" :onUpdate="() => updateNote(note)" :onDelete="() => deleteNote(note.id)" />
        <AppNote :title="newNote.title" :body="newNote.body" :onTitleChange="(event: Event) => newNote.title = (event.target as HTMLInputElement).value" :onBodyChange="(event: Event) => newNote.body = (event.target as HTMLTextAreaElement).value" :onCreate="createNote" />
        <AppButton className="danger-bg-color" title="Logout" :onClick="logout" />
    </AppLayout>
</template>
<style scoped>
</style>
<script lang="ts">
    import {defineComponent} from 'vue';
    import axios, {AxiosResponse} from 'axios';
    import AppLayout from '../components/AppLayout.vue';
    import AppTitle from '../components/AppTitle.vue';
    import AppNote, {Note} from '../components/AppNote.vue';
    import AppButton from '../components/AppButton.vue';
    import config from '../config.json';


    export default defineComponent(
        {
            name: 'HomeView',
            components: {
                AppLayout,
                AppTitle,
                AppNote,
                AppButton
            },
            mounted() {
                if (this.token !== '') {
                    this.readNotes();
                } else {
                    this.$router.push('/auth');
                }
            },
            data() {
                return {
                    notes: [] as Note[],
                    newNote: {
                        id: 0,
                        title: '',
                        body: ''
                    } as Note
                }
            },
            computed: {
                token(): string {
                    return this.$store.state.token;
                }
            },
            methods: {
                readNotes() {
                    axios.get(
                        `${config.url}/api/notes`, 
                        {
                            headers: {
                                'Authorization': `Bearer ${this.token}`
                            }
                        }
                    ).then((response: AxiosResponse<any, any>) => this.notes = response.data)
                    .catch((error: any) => console.error(error));        
                },
                createNote() {
                    if (
                        this.newNote.title !== ''
                        && this.newNote.body !== ''
                    ) {
                        axios.post(
                            `${config.url}/api/notes`, 
                            {
                                title: this.newNote.title,
                                body: this.newNote.body
                            }, 
                            {
                                headers: {
                                    'Authorization': `Bearer ${this.token}`
                                }
                            }
                        ).then((response: AxiosResponse<any, any>) => {
                            this.newNote = {
                                id: 0,
                                title: '',
                                body: ''
                            };
                            this.readNotes();
                        }).catch((error: any) => console.error(error));    
                    }
                },
                updateNote(note: Note) {
                    if (
                        note.title !== ''
                        && note.body !== ''
                    ) {
                        axios.put(
                            `${config.url}/api/notes/${note.id}`, 
                            {
                                title: note.title,
                                body: note.body
                            }, {
                            headers: {
                                'Authorization': `Bearer ${this.token}`
                            }
                        }).then((response: AxiosResponse<any, any>) => this.readNotes())
                        .catch((error: any) => console.error(error));    
                    }
                },
                deleteNote(id: number) {
                    axios.delete(
                        `${config.url}/api/notes/${id}`, 
                        {
                            headers: {
                                'Authorization': `Bearer ${this.token}`
                            }
                        }
                    ).then((response: AxiosResponse<any, any>) => this.readNotes())
                    .catch((error: any) => console.error(error));    
                },
                logout() {
                    axios.post(
                        `${config.url}/api/logout`,
                        {},
                        {
                            headers: {
                                'Authorization': `Bearer ${this.token}`
                            }
                        }
                    ).then((response: AxiosResponse<any, any>) => {
                        localStorage.removeItem('token');
                        this.$store.dispatch('logout');
                        this.$router.push('/auth');
                    }).catch((error: any) => console.error(error));    
                }
            }
        }
    );
</script>
  