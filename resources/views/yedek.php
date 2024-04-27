APİ TOKEN = YEZDJHMQJ9YSRE00CGCI68GA7KJMHSXZ
api token cpnal:09VQX4OVA233GF9TO8TWLOQ1LXU82GQB



<!DOCTYPE html>
<html lang="en">
	<head>
  <title>edan.io - your new website</title>
  <meta name="description" content="Your website in 5 minutes!">
  <meta name="robots" content="all,follow">
  <meta property="og:url" content="https://edan.io">
  <meta property="og:type" content="website">
  <meta property="og:title" content="edan.io">
  <meta property="og:description" content="edan.io - Your website in 5 minutes!">
  <meta property="og:image" content="">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('assets/css/generated.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="inter/inter.css">
  <link rel="apple-touch-icon" sizes="57x57" href="img/fav/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="img/fav/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="img/fav/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="img/fav/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="img/fav/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="img/fav/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="img/fav/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="img/fav/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="img/fav/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="img/fav/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/fav/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="img/fav/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/fav/favicon-16x16.png">
  <link rel="manifest" href="/manifest.json">
  <link rel="stylesheet" href="css/custom.css">	
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
 <script src="gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer="" type="46f65d9080e5f580b2929d15-text/javascript"></script>
    <script type="46f65d9080e5f580b2929d15-text/javascript">
      (window.Components = {
        listbox: (e) => ({
          init() {
            (this.optionCount = this.$refs.listbox.children.length),
              this.$watch("activeIndex", (e) => {
                this.open &&
                  (null !== this.activeIndex
                    ? (this.activeDescendant = this.$refs.listbox.children[
                        this.activeIndex
                      ].id)
                    : (this.activeDescendant = ""));
              });
          },
          activeDescendant: null,
          optionCount: null,
          open: !1,
          activeIndex: null,
          selectedIndex: 0,
          get active() {
            return this.items[this.activeIndex];
          },
          get [e.modelName || "selected"]() {
            return this.items[this.selectedIndex];
          },
          choose(e) {
            (this.selectedIndex = e), (this.open = !1);
          },
          onButtonClick() {
            this.open ||
              ((this.activeIndex = this.selectedIndex),
              (this.open = !0),
              this.$nextTick(() => {
                this.$refs.listbox.focus(),
                  this.$refs.listbox.children[this.activeIndex].scrollIntoView({
                    block: "nearest",
                  });
              }));
          },
          onOptionSelect() {
            null !== this.activeIndex &&
              (this.selectedIndex = this.activeIndex),
              (this.open = !1),
              this.$refs.button.focus();
          },
          onEscape() {
            (this.open = !1), this.$refs.button.focus();
          },
          onArrowUp() {
            (this.activeIndex =
              this.activeIndex - 1 < 0
                ? this.optionCount - 1
                : this.activeIndex - 1),
              this.$refs.listbox.children[this.activeIndex].scrollIntoView({
                block: "nearest",
              });
          },
          onArrowDown() {
            (this.activeIndex =
              this.activeIndex + 1 > this.optionCount - 1
                ? 0
                : this.activeIndex + 1),
              this.$refs.listbox.children[this.activeIndex].scrollIntoView({
                block: "nearest",
              });
          },
          ...e,
        }),
      }),
        (window.Components.popoverGroup = function () {
          return {
            __type: "popoverGroup",
            init() {
              let e = (t) => {
                document.body.contains(this.$el)
                  ? t.target instanceof Element &&
                    !this.$el.contains(t.target) &&
                    window.dispatchEvent(
                      new CustomEvent("close-popover-group", {
                        detail: this.$el,
                      })
                    )
                  : window.removeEventListener("focus", e, !0);
              };
              window.addEventListener("focus", e, !0);
            },
          };
        }),
        (window.Components.popover = function ({
          open: e = !1,
          focus: t = !1,
        } = {}) {
          const n = [
            "[contentEditable=true]",
            "[tabindex]",
            "a[href]",
            "area[href]",
            "button:not([disabled])",
            "iframe",
            "input:not([disabled])",
            "select:not([disabled])",
            "textarea:not([disabled])",
          ]
            .map((e) => `${e}:not([tabindex='-1'])`)
            .join(",");
          return {
            __type: "popover",
            open: e,
            init() {
              t &&
                this.$watch("open", (e) => {
                  e &&
                    this.$nextTick(() => {
                      !(function (e) {
                        const t = Array.from(e.querySelectorAll(n));
                        !(function e(n) {
                          void 0 !== n &&
                            (n.focus({ preventScroll: !0 }),
                            document.activeElement !== n &&
                              e(t[t.indexOf(n) + 1]));
                        })(t[0]);
                      })(this.$refs.panel);
                    });
                });
              let e = (n) => {
                if (!document.body.contains(this.$el))
                  return void window.removeEventListener("focus", e, !0);
                let i = t ? this.$refs.panel : this.$el;
                if (
                  this.open &&
                  n.target instanceof Element &&
                  !i.contains(n.target)
                ) {
                  let e = this.$el;
                  for (; e.parentNode; )
                    if (
                      ((e = e.parentNode), e.__x instanceof this.constructor)
                    ) {
                      if ("popoverGroup" === e.__x.$data.__type) return;
                      if ("popover" === e.__x.$data.__type) break;
                    }
                  this.open = !1;
                }
              };
              window.addEventListener("focus", e, !0);
            },
            onEscape() {
              (this.open = !1), this.restoreEl && this.restoreEl.focus();
            },
            onClosePopoverGroup(e) {
              e.detail.contains(this.$el) && (this.open = !1);
            },
            toggle(e) {
              (this.open = !this.open),
                this.open
                  ? (this.restoreEl = e.currentTarget)
                  : this.restoreEl && this.restoreEl.focus();
            },
          };
        }),
        (window.Components.radioGroup = function ({
          initialCheckedIndex: e = 0,
        } = {}) {
          return {
            value: void 0,
            init() {
              this.value = Array.from(this.$el.querySelectorAll("input"))[
                e
              ]?.value;
            },
          };
        });
    </script>
  <!-- ... -->
  
  <!-- Yandex.Metrika counter -->
<script type="46f65d9080e5f580b2929d15-text/javascript">
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(68644717, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="watch/68644717/1.gif" style="position:absolute; left:-9999px;" alt=""></div></noscript>
<!-- /Yandex.Metrika counter -->  <script type="46f65d9080e5f580b2929d15-text/javascript">
    (function (document){const script = document.createElement("script");
    script.src = "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js";
    script.async = true;
    script.dataset.adClient = atob("Y2EtcHViLTgwNDg1ODQ1Nzg5MTc5Mjg=");
    document.head.appendChild(script);})(document)
    </script>
</head>

<body>
<!--
  This example requires Tailwind CSS v2.0+ 
  
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ]
  }
  ```
-->
<div class="min-h-screen">
  
      
<!-- End Hero -->
<!--  New Hero -->
<div class="relative bg-gray-800 overflow-hidden">
    <div class="hidden sm:block sm:absolute sm:inset-0" aria-hidden="true">
      <svg class="absolute bottom-0 right-0 transform translate-x-1/2 mb-48 text-gray-700 lg:top-0 lg:mt-28 lg:mb-0 xl:transform-none xl:translate-x-0" width="364" height="384" viewbox="0 0 364 384" fill="none">
        <defs>
          <pattern id="eab71dd9-9d7a-47bd-8044-256344ee00d0" x="0" y="0" width="20" height="20" patternunits="userSpaceOnUse">
            <rect x="0" y="0" width="4" height="4" fill="currentColor"></rect>
          </pattern>
        </defs>
        <rect width="364" height="384" fill="url(#eab71dd9-9d7a-47bd-8044-256344ee00d0)"></rect>
      </svg>
    </div>
    <div class="relative pt-6 pb-16 sm:pb-24" x-data="Components.popover({ open: false, focus: true })" x-init="init()" @keydown.escape="onEscape" @close-popover-group.window="onClosePopoverGroup">
      <nav class="relative max-w-7xl mx-auto flex items-center justify-between px-4 sm:px-6" aria-label="Global">
        <div class="flex items-center flex-1">
          <div class="flex items-center justify-between w-full md:w-auto">
            <a href="#">
              <span class="sr-only">Workflow</span>
              <img class="h-8 w-auto sm:h-10" src="img/start/logo.png" alt="">
            </a>
            <div class="-mr-2 flex items-center md:hidden">
              <button type="button" class="bg-gray-800 rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:bg-gray-700 focus:outline-none focus:ring-2 focus-ring-inset focus:ring-white" @click="toggle" @mousedown="if (open) $event.preventDefault()" aria-expanded="false" :aria-expanded="open.toString()">
                <span class="sr-only">get discovered</span>
                <svg class="h-6 w-6" x-description="Heroicon name: outline/menu" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
</svg>
              </button>
            </div>
          </div>
          <div class="hidden space-x-10 md:flex md:ml-10">
	          
	            <a href="#features" class="font-medium text-white hover:text-gray-300">Features</a>
            
              <a href="#testimonials" class="font-medium text-white hover:text-gray-300">Testimonials</a>
            
              <a href="#examples" class="font-medium text-white hover:text-gray-300">Examples</a>
            
              <a href="#faq" class="font-medium text-white hover:text-gray-300">FAQ</a>
            
          </div>
        </div>
        <div class="hidden md:flex">
          <a href="gui/en/site/account/choose.php.html" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700">Login/Register</a>
        </div>
      </nav>

      
        <div x-show="open" x-transition:enter="duration-150 ease-out" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="duration-100 ease-in" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" x-description="Mobile menu, show/hide based on menu open state." class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden" x-ref="panel" @click.away="open = false" style="display: none;">
          <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
            <div class="px-5 pt-4 flex items-center justify-between">
              <div>
                <img class="h-8 w-auto" src="img/logos/workflow-mark-indigo-600.svg" alt="">
              </div>
              <div class="-mr-2">
                <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" @click="toggle">
                  <span class="sr-only">Close menu</span>
                  <svg class="h-6 w-6" x-description="Heroicon name: outline/x" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
</svg>
                </button>
              </div>
            </div>
            <div class="px-2 pt-2 pb-3 space-y-1">
	            <a href="#features" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Features</a>

              
                <a href="#testimonials" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Testimonials</a>
              
              
                <a href="#examples" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Examples</a>
              
                <a href="#faq" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">FAQ</a>
              
            </div>
            <a href="gui/en/site/account/choose.php.html" class="block w-full px-5 py-3 text-center font-medium text-indigo-600 bg-gray-50 hover:bg-gray-100">Login/Register</a>
          </div>
        </div>
      

      <main class="mt-16 sm:mt-24">
        <div class="mx-auto max-w-7xl">
          <div class="lg:grid lg:grid-cols-12 lg:gap-8">
            <div class="px-4 sm:px-6 sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left lg:flex lg:items-center">
              <div>

                <h1 class="mt-4 text-4xl tracking-tight font-extrabold text-white sm:mt-5 sm:text-6xl lg:mt-6 xl:text-6xl">
                  <span class="block">get discovered</span>
                  <span class="block text-indigo-400">be present <br> be online</span>
                </h1>
                <p class="mt-3 text-base text-gray-300 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">85% of all people search on the Internet for services, restaurants, and much more.</p>
                <p class="mt-3 text-base text-gray-300 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl ">With a website from edan.io you will receive <b>more customer inquiries</b>!</p>
                <p class="mt-3 text-base text-gray-300 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">Your website in 5 minutes!</p>
                <div class="mt-10 sm:mt-12">
                  <form action="/gui/site/account/choose.php" method="get" class="sm:max-w-xl sm:mx-auto lg:mx-0">
                    <div class="sm:flex">
                      <div class="min-w-0 flex-1">
                        <input id="email" name="email" type="email" placeholder="Your email address" class="block w-full px-4 py-3 rounded-md border-0 text-base text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 focus:ring-offset-gray-900">
                      </div>
                      <div class="mt-3 sm:mt-0 sm:ml-3">
                        <button type="submit" class="block w-full py-3 px-4 rounded-md shadow bg-indigo-500 text-white font-medium hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 focus:ring-offset-gray-900">Register for free</button>
                      </div>
                    </div>
                    <p class="mt-3 text-sm text-gray-300 sm:mt-4">✓ no costs ✓ no obligations ✓ no stress</p>
                  </form>
                </div>
              </div>
            </div>
            <div class="mt-16 sm:mt-24 lg:mt-0 lg:col-span-6 lg:flex">
              <div class="sm:max-w-md sm:w-full sm:mx-auto sm:rounded-lg sm:overflow-hidden lg:flex">
                <div class="px-4 py-8 sm:px-10 lg:flex">
                                  <img class="w-auto lg:inset-y-0 lg:left-0 lg:flex lg:w-auto" src="img/start/hero3.png" alt="">

                </div>
 
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
<!--  End new Hero -->
<!-- Features -->
<div class="py-12 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="lg:text-center" id="features">
      <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Features</h2>
      <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">What we offer you</p>
      <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">With edan.io you create a web presence that is adapted to your and especially your customers' needs.</p>
    </div>

    <div class="mt-10">
      <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
        <div class="relative">
          <dt>
            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
              <!-- Heroicon name: outline/globe-alt -->
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
            </div>
            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Quick contact options</p>
          </dt>
          <dd class="mt-2 ml-16 text-base text-gray-500">Reach your customers in their preferred ways. Integrate buttons for email, Whatsapp, Google maps, and more.</dd>
        </div>

        <div class="relative">
          <dt>
            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
              <!-- Heroicon name: outline/scale -->
<svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>
            </div>
            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Modular structure</p>
          </dt>
          <dd class="mt-2 ml-16 text-base text-gray-500">Our modules fit your industry. For example, adding a menu to your restaurant is a breeze.</dd>
        </div>

        <div class="relative">
          <dt>
            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
              <!-- Heroicon name: outline/lightning-bolt -->
<svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>  
            </div>
            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Review Management</p>
          </dt>
          <dd class="mt-2 ml-16 text-base text-gray-500">Manage the displayed reviews of your customers. It's YOUR website! You decide what is displayed!</dd>
        </div>

        <div class="relative">
          <dt>
            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
              <!-- Heroicon name: outline/annotation -->
<svg class="w-6 h-6" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
            </div>
            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Fast support</p>
          </dt>
          <dd class="mt-2 ml-16 text-base text-gray-500">Our support staff can be reached quickly and personally.</dd>
        </div>
      </dl>
    </div>
  </div>
</div>
<!-- End Features -->
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
    <h2 class="text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl" id="examples">Need some inspiration?</h2>
      <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">These pages were created with edan.io and bring their creators new customers.</p>
   <a href=""><img class="h-104 w-full object-cover" src="img/start/examples.jpg" loading="lazy" alt=""></a>
</div>

<!-- Testimonials -->
<div class="bg-white pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
  <div class="relative max-w-lg mx-auto divide-y-2 divide-gray-200 lg:max-w-7xl">
    <div>
      <h2 class="text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl text-center" id="testimonials">What our customers say</h2>
      
    </div>
    <div class="mt-12 grid gap-16 pt-12 lg:grid-cols-3 lg:gap-x-5 lg:gap-y-12">
      <div>
        <a href="#" class="block mt-4">
          <p class="text-xl font-semibold text-gray-900">New customers through the Internet</p>
          <p class="mt-3 text-base text-gray-500">Thanks to our new web presence, noticeably more customers have contacted us.</p>
        </a>
        <div class="mt-6 flex items-center">
          <div class="flex-shrink-0">
            <a href="#">
              <span class="sr-only">Mike P.</span>
              <img class="h-20 w-20 rounded-full" src="img/start/mike.jpg" alt="">
            </a>
          </div>
          <div class="ml-3">
            <p class="text-sm font-medium text-gray-900">Mike P.</p>
            <div class="flex space-x-1 text-sm text-gray-500">
              <span>Owner of a law firm</span>
            </div>
          </div>
        </div>
      </div>

      <div>
        
        <a href="#" class="block mt-4">
          <p class="text-xl font-semibold text-gray-900">Give (potential) customers a quick overview</p>
          <p class="mt-3 text-base text-gray-500">Now I can process requests faster by linking to my new website.</p>
        </a>
        <div class="mt-6 flex items-center">
          <div class="flex-shrink-0">
            <a href="#">
              <span class="sr-only">Stephanie V.</span>
              <img class="h-20 w-20 rounded-full" src="img/start/steph.jpg" alt="">
            </a>
          </div>
          <div class="ml-3">
            <p class="text-sm font-medium text-gray-900">Stephanie V.</p>
            <div class="flex space-x-1 text-sm text-gray-500">
              <span>Freelance consultant</span>
            </div>
          </div>
        </div>
      </div>

      <div>
        <a href="#" class="block mt-4">
          <p class="text-xl font-semibold text-gray-900">Faster accessibility</p>
          <p class="mt-3 text-base text-gray-500">We can now be reached faster by customers and receive more reservations.</p>
        </a>
        <div class="mt-6 flex items-center">
          <div class="flex-shrink-0">
            <a href="#">
              <span class="sr-only">Martha E.</span>
              <img class="h-20 w-20 rounded-full" src="img/start/martha.jpg" alt="">
            </a>
          </div>
          <div class="ml-3">
            <p class="text-sm font-medium text-gray-900">Martha E.</p>
            <div class="flex space-x-1 text-sm text-gray-500">
              <span>Restaurantbesitzerin</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Testimonials -->


<!-- FAQ -->
<div class="bg-gray-50">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8">
      <div class="max-w-3xl mx-auto divide-y-2 divide-gray-200">
        <h2 class="text-center text-3xl font-extrabold text-gray-900 sm:text-4xl" id="faq">Frequently asked questions</h2>
        <dl class="mt-6 space-y-6 divide-y divide-gray-200" x-max="1">
          
            <div x-data="{ open: true }" class="pt-6">
              <dt class="text-lg">
                <button type="button" x-description="Expand/collapse question button" class="text-left w-full flex justify-between items-start text-gray-400" aria-controls="faq-0" @click="open = !open" aria-expanded="true" x-bind:aria-expanded="open.toString()">
                  <span class="font-medium text-gray-900">How much does the service cost?</span>
                  <span class="ml-6 h-7 flex items-center">
                    <svg class="h-6 w-6 transform -rotate-180" x-description="Expand/collapse icon, toggle classes based on question open state.

Heroicon name: outline/chevron-down" x-state:on="Open" x-state:off="Closed" :class="{ '-rotate-180': open, 'rotate-0': !(open) }" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
</svg>
                  </span>
                </button>
              </dt>
              <dd class="mt-2 pr-12" id="faq-0" x-show="open">
                <p class="text-base text-gray-500">Nothing. You can create a basic page for free. Premium features can be added later</p>
              </dd>
            </div>
          
            <div x-data="{ open: false }" class="pt-6">
              <dt class="text-lg">
                <button type="button" x-description="Expand/collapse question button" class="text-left w-full flex justify-between items-start text-gray-400" aria-controls="faq-1" @click="open = !open" aria-expanded="false" x-bind:aria-expanded="open.toString()">
                  <span class="font-medium text-gray-900">Is edan.io the right service for me?</span>
                  <span class="ml-6 h-7 flex items-center">
                    <svg class="rotate-0 h-6 w-6 transform" x-description="Expand/collapse icon, toggle classes based on question open state.

Heroicon name: outline/chevron-down" x-state:on="Open" x-state:off="Closed" :class="{ '-rotate-180': open, 'rotate-0': !(open) }" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
</svg>
                  </span>
                </button>
              </dt>
              <dd class="mt-2 pr-12" id="faq-1" x-show="open" style="display: none;">
                <p class="text-base text-gray-500">If you have a business, you should have a web presence. Many people nowadays use the Internet to find services.</p>
              </dd>
            </div>
          
            <div x-data="{ open: false }" class="pt-6">
              <dt class="text-lg">
                <button type="button" x-description="Expand/collapse question button" class="text-left w-full flex justify-between items-start text-gray-400" aria-controls="faq-2" @click="open = !open" aria-expanded="false" x-bind:aria-expanded="open.toString()">
                  <span class="font-medium text-gray-900">I have no idea about creating a website. What do I do now?</span>
                  <span class="ml-6 h-7 flex items-center">
                    <svg class="rotate-0 h-6 w-6 transform" x-description="Expand/collapse icon, toggle classes based on question open state.

Heroicon name: outline/chevron-down" x-state:on="Open" x-state:off="Closed" :class="{ '-rotate-180': open, 'rotate-0': !(open) }" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
</svg>
                  </span>
                </button>
              </dt>
              <dd class="mt-2 pr-12" id="faq-2" x-show="open" style="display: none;">
                <p class="text-base text-gray-500">You do not need any previous experience. Our service is for everyone. Even to people who have no previous experience with the Internet or creating a website.</p>
              </dd>
            </div>
          
            <div x-data="{ open: false }" class="pt-6">
              <dt class="text-lg">
                <button type="button" x-description="Expand/collapse question button" class="text-left w-full flex justify-between items-start text-gray-400" aria-controls="faq-3" @click="open = !open" aria-expanded="false" x-bind:aria-expanded="open.toString()">
                  <span class="font-medium text-gray-900">Can I use my own domain?</span>
                  <span class="ml-6 h-7 flex items-center">
                    <svg class="rotate-0 h-6 w-6 transform" x-description="Expand/collapse icon, toggle classes based on question open state.

Heroicon name: outline/chevron-down" x-state:on="Open" x-state:off="Closed" :class="{ '-rotate-180': open, 'rotate-0': !(open) }" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
</svg>
                  </span>
                </button>
              </dt>
              <dd class="mt-2 pr-12" id="faq-3" x-show="open" style="display: none;">
                <p class="text-base text-gray-500">Yes! You can use your domain and redirect to your web presence with us.</p>
              </dd>
            </div>


            <div x-data="{ open: false }" class="pt-6">
              <dt class="text-lg">
                <button type="button" x-description="Expand/collapse question button" class="text-left w-full flex justify-between items-start text-gray-400" aria-controls="faq-3" @click="open = !open" aria-expanded="false" x-bind:aria-expanded="open.toString()">
                  <span class="font-medium text-gray-900">I would like to have my own domain. But I have no idea how to do that. Can you help?</span>
                  <span class="ml-6 h-7 flex items-center">
                    <svg class="rotate-0 h-6 w-6 transform" x-description="Expand/collapse icon, toggle classes based on question open state.

Heroicon name: outline/chevron-down" x-state:on="Open" x-state:off="Closed" :class="{ '-rotate-180': open, 'rotate-0': !(open) }" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
</svg>
                  </span>
                </button>
              </dt>
              <dd class="mt-2 pr-12" id="faq-3" x-show="open" style="display: none;">
                <p class="text-base text-gray-500"><a href='burgers-on-broadway.html'>Burger</a> <a href='bundt-park-dog-park.html'>Park</a> <a href='cafe-35.html'>Cafe</a></p>
              </dd>
            </div>
          
          
        </dl>
      </div>
    </div>
  </div>
<!-- FAQ END -->
<footer class="bg-grey-800">
  <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
    <nav class="-mx-5 -my-2 flex flex-wrap justify-center" aria-label="Footer">
      <div class="px-5 py-2">
        <a href="/contact-more" class="text-base text-gray-500 hover:text-gray-900 hidden" rel="nofollow">Contact</a>
        <a href="https://edan.io/contact" class="text-base text-gray-500 hover:text-gray-900">Contact</a>
      </div>

      <div class="px-5 py-2">
        <a href="privacy.html" class="text-base text-gray-500 hover:text-gray-900">Privacy</a>
      </div>

      <div class="px-5 py-2">
        <a href="terms.html" class="text-base text-gray-500 hover:text-gray-900">Terms and conditions</a>
      </div>

      <div class="px-5 py-2">
        <a href="about.html" class="text-base text-gray-500 hover:text-gray-900">About</a>
      </div>

    </nav>
    
    <p class="mt-8 text-center text-base text-gray-400">© 2023 edan.io. All rights reserved.</p>
  </div>
      </footer>
    
  </div>
 <script type="46f65d9080e5f580b2929d15-text/javascript">
    var basePath = ''
  </script>


<script src="cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="46f65d9080e5f580b2929d15-|49" defer=""></script></body>
</html>