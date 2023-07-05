import DOMPurify from "dompurify";

export default class Search {
    constructor() {
        this.searchIcon = document.querySelector("#search-friends")
        this.emptyFollowingBtn = document.querySelector("#emptyFollowingBtn")
        this.closeIcon = document.querySelector(".close-icon")
        this.searchInput = document.querySelector(".search-input")
        this.searchContainer = document.querySelector(".search-container")
        this.searchResult = document.querySelector(".search-result")
        this.loading = document.querySelector(".loading")
        this.events()
    }

    events() {
        this.searchIcon.addEventListener("click", () => this.showSearchContainer())
        this.emptyFollowingBtn.addEventListener("click", () => this.showSearchContainer())
        this.closeIcon.addEventListener("click", () => this.hideSearchContainer())
        this.searchInput.addEventListener("input", (event) => this.searchUsers(event))
    }

    // ======= Methods ======
    searchUsers(event) {
        // Store search input value (keyword) from user in searchKeyword
        let inputValue = event.target.value
        this.searchKeyword = inputValue

        // If the search input is empty, do not show any result
        if(inputValue === "") {
            clearTimeout(this.requestTimer)
            
            // Hide loading icon and search result
            this.hideLoading()
            this.hideSearchResult()
        }
        // If user type something in search input, show the results
        else if (inputValue !== '') {
            clearTimeout(this.requestTimer)

            // Show loading icon and hide search result
            this.showLoading()
            this.hideSearchResult()
            
            // After a few seconds, send request to get the data
            this.requestTimer = setTimeout(() => {this.sendRequest()}, 600)
        }
    }

    async sendRequest() {
        // Get the users data from database
        const results = await axios.get(`/search/${this.searchKeyword}`)
        // Render the results
        this.renderResult(results.data)
    }

    renderResult(users) {
        // Hide loading icon and show search result
        this.hideLoading()
        this.showSearchResult()

        // If there are some results, show every user card
        if(users.length) {
            this.searchResult.innerHTML = DOMPurify.sanitize(
                `${users.map(user => {
                    return `
                    <a href="/profile/${user.username}">
                        <div class="card card__followers card-user">
                            <div class="card-header-container">
                                <div class="profile-detail">
                                    <img class="profile-detail__image photo photo--small" src="${user.avatar}" alt="">
                                    <span class="profile-detail__name">${user.username}</span>
                                </div>  
                            </div>    
                        </div>
                    </a>`
                }).join("")}`
            )
        }
        // If there is no result, show 'Users not found'
        else {
            this.searchResult.innerHTML = `<div class="alert-text small-text">Users not found</div>`
        }
    }

    showSearchContainer() {
        this.searchContainer.classList.add("show")
    }

    hideSearchContainer() {
        this.searchContainer.classList.remove("show")
    }

    showSearchResult() {
        this.searchResult.classList.remove("hide")
    }

    hideSearchResult() {
        this.searchResult.classList.add("hide")
    }

    showLoading() {
        this.loading.classList.add("show")
    }

    hideLoading() {
        this.loading.classList.remove("show")
    }
}