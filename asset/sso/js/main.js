/** SSO Widget Library Version 1.1 */

class SSO {
    constructor(params = {}) {
        this.params = params;

        // Detect if user is on IE browser
        var isIE = !!window.MSInputMethodContext && !!document.documentMode;

        if (isIE) {
            // Create Promise polyfill script tag
            var promiseScript = document.createElement("script");
            promiseScript.type = "text/javascript";
            promiseScript.src =
                "https://cdn.jsdelivr.net/npm/promise-polyfill@8.1.3/dist/polyfill.min.js";

            // Create Fetch polyfill script tag
            var fetchScript = document.createElement("script");
            fetchScript.type = "text/javascript";
            fetchScript.src =
                "https://cdn.jsdelivr.net/npm/whatwg-fetch@3.4.0/dist/fetch.umd.min.js";

            // Add polyfills to head element
            document.head.appendChild(promiseScript);
            document.head.appendChild(fetchScript);

            if (this.params.debug) {
                console.info('[SSO WIDGET] - Fetch Lib Injected to Document Head')
            }
        }

        if (this.params.debug) {
            console.info('[SSO WIDGET] - Plugin Initialized')
        }

        this.openElement = this.openElement.bind(this);
        this.closeElement = this.closeElement.bind(this);
        this.initComponent = this.initComponent.bind(this);
        this.hasClass = this.hasClass.bind(this);
        this.removeClass = this.removeClass.bind(this);
        this.addClass = this.addClass.bind(this);
        this.getAppList = this.getAppList.bind(this);
        this.appendApp = this.appendApp.bind(this);
    }

    initComponent(el) {
        if (this.params.debug) {
            console.info('[SSO WIDGET] - Creating Component')
        }
        let element = el || 'body';
        let component = `
            <div id="sso_floating_widget">
                <i id="sso_icon_btn" class="fa fa-th-large fa-2x" aria-hidden="true"></i>
                <div id="sso_floating_container">
                    <div class="sso-header">
                        <span class="sso-title">
                            APLIKASI SATU AKSES DCKTRP DKI JAKARTA
                        </span>
                        <button id="sso_close_btn">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>                        
                    </div>

                    <div class="sso-loader" style="display: block"></div>
                    <div class="sso-profile-wrapper"></div>
                    <div class="sso-list" style="display:none"></div>
                </div>
            </div>
        `;
        let selector = '';
        if (element == 'body') {
            selector = document.querySelector('body');
            selector.innerHTML = component + selector.innerHTML;
        } else {
            selector = document.querySelector(element);
            selector.innerHTML = component;
        }

        if (this.params.debug) {
            console.info('[SSO WIDGET] - Appending Component')
        }

        document.querySelector('#sso_floating_widget').addEventListener('click', this.openElement)

        let $this = this;

        setTimeout(function () {
            $this.addClass(document.querySelector('#sso_floating_widget'), 'sso-enter')
        }, 500);

        if (this.params.debug) {
            console.info('[SSO WIDGET] - Component Ready');
        }
        this.renderUserProfile()
        this.appendApp();

    }

    renderUserProfile = async () => {
        let detail_user = await this.getDetailUser();
        
        let fullname = detail_user.nama;
        let username = detail_user.username;

        // GET INITIAL NAME
        let initial_name = "";
        const arr_initial_name = fullname.split(' ').slice(0, 3);
        arr_initial_name.forEach(el => {
            initial_name += el[0];
        });

        let sso_service_url = this.params.sso_services_url || "https://dcktrp.jakarta.go.id/satuakses/service/";
        let sso_app_url = sso_service_url.split('/');
        
        // Remove "service/" string
        sso_app_url.pop();
        sso_app_url.pop();

        sso_app_url = sso_app_url.join('/') + '/app/';

        // GENERATE COMPONENT
        let comp = `
            <div class="sso-image-profile">
                ${initial_name}
            </div>
            <div class="sso-user-info">
                <b class="sso-fullname">${fullname}</b>
                <span class="sso-username">${username}</span>
                <a href="${sso_app_url}profile" target="_blank" rel="nofollow noreferrer noopener">Lihat Profil Satu Akses</a>
            </div>
        `;
        document.querySelector('#sso_floating_container .sso-profile-wrapper').innerHTML = comp;

    }

    appendApp = async () => {
        let applist = await this.getAppList();

        let comp = "";

        applist.forEach(function (el) {
            comp += `
                <a href="${el.url}" target="_blank" rel="nofollow noreferrer noopener" class="sso-item">
                    <div class="sso-icon">
                        <img src="${el.icon}">
                    </div>
                    <div class="sso-desc">
                        <b>${el.name}</b>
                        <br>
                        <br>
                        ${el.url}
                    </div>
                </a>
            `;
        });

        document.querySelector('#sso_floating_container .sso-list').innerHTML = comp;

        document.querySelector('#sso_floating_container .sso-loader').style.display = 'none';
        document.querySelector('#sso_floating_container .sso-list').style.display = 'block';
        if (this.params.debug) {
            console.info('[SSO WIDGET] - Append Apps to List Component');
        }
    }

    openElement() {
        document.querySelector('#sso_icon_btn').style.display = "none";
        let element = document.querySelector('#sso_floating_widget');
        this.addClass(element, 'sso-expand');
        this.addClass(document.querySelector('#sso_floating_container'), 'sso-enter');
        let $this = this;
        if (this.params.debug) {
            console.info('[SSO WIDGET] - Component Openend')
        }

        element.removeEventListener('click', $this.openElement);
        document.querySelector('#sso_close_btn').addEventListener('click', $this.closeElement)

    }

    closeElement() {
        let $this = this;
        setTimeout(function () {
            $this.removeClass(document.querySelector('#sso_floating_widget'), 'sso-expand');
        }, 0)

        document.querySelector('#sso_icon_btn').style.display = 'block';

        this.removeClass(document.querySelector('#sso_floating_container'), 'sso-enter');
        document.querySelector('#sso_floating_container').style.display = 'none';

        document.querySelector('#sso_close_btn').removeEventListener('click', this.closeElement);

        setTimeout(function () {
            $this.removeClass(document.querySelector('#sso_floating_container'), 'sso-enter');
            document.querySelector('#sso_floating_container').style.display = 'flex';
            document.querySelector('#sso_floating_widget').addEventListener('click', $this.openElement)
        }, 500);

        if (this.params.debug) {
            console.info('[SSO WIDGET] - Component Closed')
        }
    }

    hasClass(el, className) {
        if (el.classList)
            return el.classList.contains(className);
        return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
    }

    addClass(el, className) {
        if (el.classList)
            el.classList.add(className)
        else if (!this.hasClass(el, className))
            el.className += " " + className;
    }

    removeClass(el, className) {
        if (el.classList) {
            el.classList.remove(className)
        } else if (this.hasClass(el, className)) {
            var reg = new RegExp('(\\s|^)' + className + '(\\s|$)');
            el.className = el.className.replace(reg, ' ');
            el.className
        }
    }

    getAppList = async function () {
        if (this.params.debug) {
            console.info('[SSO WIDGET] - Getting App List');
        }
        let sso_token = this.getCookie('sso_dcktrp');
        let SSO_URL = this.params.sso_services_url || 'https://dcktrp.jakarta.go.id/satuakses/service/';

        if (this.params.hasOwnProperty('cors') && !this.params.cors) {
            let proxyUrl = 'https://cors-anywhere.herokuapp.com/';
            SSO_URL = proxyUrl + SSO_URL;
        }

        // GET USER INFO FROM SSO_TOKEN
        let decoded_token = await fetch(`${SSO_URL}app-user`, {
            method: 'GET',
            headers: {
                'app-key': '34ddf92c-b195-4e72-ab4c-b9b7c0c04810',
                'authorization': sso_token,
            }
        })
            .then(res => res.json())
            .catch(err => {
                throw new Error(err);
            });

        if (this.params.debug) {
            console.info('[SSO WIDGET] - Get App List Completed');
        }

        if (decoded_token.status == 'success') {
            return decoded_token.app_list;
        } else {
            throw new Error(decoded_token.msg);
        }

    }

    getDetailUser = async function () {
        if (this.params.debug) {
            console.info('[SSO WIDGET] - Getting Detail User');
        }

        let sso_token = this.getCookie('sso_dcktrp');
        let SSO_URL = this.params.sso_services_url || 'https://dcktrp.jakarta.go.id/satuakses/service/';

        if (this.params.hasOwnProperty('cors') && !this.params.cors) {
            let proxyUrl = 'https://cors-anywhere.herokuapp.com/';
            SSO_URL = proxyUrl + SSO_URL;
        }

        let detail_user = await fetch(`${SSO_URL}auth`, {
            method: 'GET',
            headers: {
                'app-key': '34ddf92c-b195-4e72-ab4c-b9b7c0c04810',
                'authorization': sso_token,
            }
        })
            .then(res => res.json())
            .catch(err => {
                throw new Error(err);
            });

        if (this.params.debug) {
            console.info('[SSO WIDGET] - Get Detail User Completed');
        }

        if (detail_user.status == 'success') {
            return detail_user.payload;
        } else {
            throw new Error(detail_user.msg);
        }
    }

    getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    createCookie(name, value, days) {
        var expires;
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        }
        else {
            expires = "";
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }
}
