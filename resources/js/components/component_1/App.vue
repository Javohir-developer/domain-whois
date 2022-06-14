<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <dev class="navbar-nav">
                    <router-link class="nav-item nav-link" :to="{name:'home'}">home</router-link>
                </dev>
            </div>
        </nav>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
}
</script>

