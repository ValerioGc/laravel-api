<template>
    <header>
        <nav>
            <div class="logo">
                <a href="#">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg" alt="Logo">
                </a>
            </div>
            <a href="#" class="hamburger"  @click.prevent="showMenu()">
                <i class="fa-2x fa-solid fa-bars"></i>
            </a>
            <ul class="navItems" :class="(showMobileMenu === true)? 'd-none':'d-flex'">
                <li v-for="(item, index) in navItems" :key="index"> <!-- :class="( == item)?'active':''"-->
                    <a :href="item.link">{{item.page}}</a>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script>
    export default {
        name:'appHeader',
        methods: {
          showMenu() {
              if (this.showMobileMenu !== true) {
                this.showMobileMenu = true;
              }
              else {
                  this.showMobileMenu = false;
              }
          }
        },
        data() {
            return {
                showMobileMenu: false,
                navItems: [
                    {
                        page:'Home',
                        link:'#'
                    },
                    {
                        page:'Post',
                        link:'#'
                    },
                    {
                        page:'Post Recenti',
                        link:'#'
                    },
                    {
                        page:'Categorie',
                        link:'#'
                    }
                ]
            }
        }
    }
</script>

<style lang="scss" scoped>

    header {
        width: 100%;
        position: fixed;
        top: 0;
        z-index: 99;
        background-color: #909fa9;
        box-shadow: 2px 2px 5px #000;

        .logo {
            width: 50px;
            padding: 1rem 0;
        }

        .hamburger {
            display: none;

            @media screen and (max-width: 978px){
                display: inline-block;
            }
        }

        nav  {
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;

            .navItems  {
                display: flex;
                justify-content: space-between;
                flex-basis: 50%;
                align-items: center;
                margin:0;

                @media screen and (max-width: 978px){
                    display: none;
                    flex-direction: column;
                    background-color: #94a6ab;
                    border-bottom: 2px solid green;
                    position: absolute;
                    text-align: center;
                    left: 0;
                    right: 0;
                    top: 5rem;
                    color: black;
                }

                .active {
                    border-color: blue;
                }

                li {
                    border-bottom: 3px solid transparent;
                     &:hover {
                         border-color: blue;

                     }

                    a {
                        line-height: 5rem;
                        font-size: 18px;
                        font-weight: bold;
                    }
                }
            }
        }
    }

</style>
