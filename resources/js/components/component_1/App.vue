<template>
    <div class="container">
        <h3 class="mt-4">Domains whois</h3>
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <textarea type="text" v-model="domain" class="form-control" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
        <div class="table-domain" v-if="display">
            <h2 class="table-title">list of domains</h2>
            <table class="table mt-4">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Info</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody class="table_rows">
                <tr v-for="(domain, index) in domains" :key="index">
                    <td>{{domain.domainName}}</td>
                    <td><p v-if="domain.domainName">{{domain.owner}}</p><p v-else>such a domain does not exist</p></td>
                    <td><p v-if="domain.domainName">domain active</p><p v-else>domain is not active</p></td>
                </tr>
                <tr v-if="errored !== null">
                    <td></td>
                    <td>{{errored}}</td>
                    <td>domain is not active</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            domains:[],
            domain: null,
            display: false,
            errored: null,
        }
    },
    methods:{
        onlyUnique(value, index, self) {
            return self.indexOf(value) === index;
        },
        submitForm(){
            this.display = true
            var arr =  this.domain.split(" ").filter(this.onlyUnique)
            arr.forEach((value, index) => {
                axios.post('/domain-whois/domain-whois',{
                    domain: value
                })
                .then(response => {
                    this.domains.push(response.data)
                })
                .catch(error => {
                    this.errored = error.response.data.message
                })
            });
        },
    },

}
</script>
<style>
    .table-title{
        text-align: center;
    }
</style>
