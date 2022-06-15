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
                    <th scope="col">Photo</th>
                    <th scope="col">Status</th>
                    <th scope="col">view</th>
                </tr>
                </thead>
                <tbody class="table_rows">
                <tr v-for="(domain, index) in domains" :key="index">
                    <td>{{domain.domainName}}</td>
                    <td><p v-if="domain.domainName">{{domain.owner}}</p><p v-else>such a domain does not exist</p></td>
                    <td><p v-if="domain.domainName"><img v-bind:src="'/' + domain.domainName + '.jpeg'" height="100px" width="100px"/> </p><p v-else>🥵</p></td>
                    <td><p v-if="domain.domainName">domain active</p><p v-else>domain is not active</p></td>
                    <td>
                        <p v-if="domain.domainName">
                            <router-link class="nav-item nav-link" :to="{name:'view', params:{image: domain.domainName + '.jpeg'}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </router-link>
                        </p>
                        <p v-else>🥵</p>
                    </td>
                </tr>
                <tr v-if="errored !== null">
                    <td></td>
                    <td>{{errored}}</td>
                    <td>domain is not active</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div>
            <router-view></router-view>
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
                .then(response_1 => {
                    console.log(response_1.data.domainName);
                    axios.post('/domain-whois/domain-screenshot',{
                        domain: response_1.data.domainName
                    })
                    .then(response_2 => {
                        this.domains.push(response_1.data, response_2.data)
                        console.log(response_1.data, response_2.data)
                    })
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
