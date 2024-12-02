function Edit(e){let t=e.target.getAttribute("data-id"),l=e.target.getAttribute("data-app"),a=e.target.getAttribute("data-email"),r=e.target.getAttribute("data-password"),o=document.createElement("div");o.classList.add("MODAL","absolute","w-[450px]","h-[330px]","bg-[#222222]","shadow-xl","rounded-lg","z-40","left-1/2","top-1/2","transform","-translate-x-1/2","-translate-y-1/2"),o.innerHTML=`<form action="" method="POST"><input id="editId" type="hidden" name="id" value="${t}"><div class="flex flex-col justify-around items-center mt-10 space-y-4"><div class="relative"><input autocomplete="off" class="peer p-4 placeholder-transparent outline-none text-white w-[390px] h-[55px] border-[#ffffff] border rounded-xl bg-transparent" id="app" name="app" type="text" placeholder=" " value="${l}"><label for="app" class="absolute pl-1 pr-1 transition-all text-white bg-[#222222] peer-placeholder-shown:top-4 peer-placeholder-shown:left-4 peer-focus:-top-3 peer-focus:left-4 -top-3 left-4">App</label></div><div class="relative"><input autocomplete="off" class="peer p-4 placeholder-transparent outline-none text-white w-[390px] h-[55px] border-[#ffffff] border rounded-xl bg-transparent" id="email" name="email" type="email" placeholder=" " value="${a}"><label for="email" class="absolute pl-1 pr-1 transition-all text-white bg-[#222222] peer-placeholder-shown:top-4 peer-placeholder-shown:left-4 peer-focus:-top-3 peer-focus:left-4 -top-3 left-4">Email</label></div><div class="relative"><input autocomplete="off" class="peer p-4 placeholder-transparent outline-none text-white w-[390px] h-[55px] border-[#ffffff] border rounded-xl bg-transparent" id="password" name="password" type="text" placeholder=" " value="${r}"><label for="password" class="absolute pl-1 pr-1 transition-all text-white bg-[#222222] peer-placeholder-shown:top-4 peer-placeholder-shown:left-4 peer-focus:-top-3 peer-focus:left-4 -top-3 left-4">Password</label></div></div><div class="flex justify-around items-center mt-6"><button type="submit" name="edit" class="w-[80px] h-[35px] bg-green-700 border-green-800 border-2 rounded-md">Save</button><button type="button" onclick="cancelModal()" class="w-[80px] h-[35px] bg-gray-700 border-gray-800 border-2 rounded-md">Cancel</button></div></form>`,document.getElementById("section").style.filter="blur(4px)",document.getElementById("section").style.pointerEvents="none",document.body.appendChild(o)}function cancelModal(){let e=document.querySelector(".MODAL");document.getElementById("section").style.filter="",document.getElementById("section").style.pointerEvents="",e&&e.remove()}
function open_add_modal(){const modal=document.createElement('div');modal.classList.add('ADD_MODAL','absolute','w-[450px]','h-[330px]','bg-[#222222]','shadow-xl','rounded-lg','z-40','left-1/2','top-1/2','transform','-translate-x-1/2','-translate-y-1/2');modal.innerHTML=`<form action="" method="POST"><input type="hidden" value=""><div class="flex flex-col justify-around items-center mt-10 space-y-4"><div class="relative"><input autocomplete="off" class="peer p-4 placeholder-transparent outline-none text-white w-[390px] h-[55px] border-[#ffffff] border rounded-xl bg-transparent" id="app" name="app" type="text" placeholder=" " /><label for="app" class="absolute pl-1 pr-1 transition-all text-white bg-[#222222] peer-placeholder-shown:top-4 peer-placeholder-shown:left-4 peer-focus:-top-3 peer-focus:left-4 -top-3 left-4">App</label></div><div class="relative"><input autocomplete="off" class="peer p-4 placeholder-transparent outline-none text-white w-[390px] h-[55px] border-[#ffffff] border rounded-xl bg-transparent" id="email" name="email" type="email" placeholder=" " /><label for="email" class="absolute pl-1 pr-1 transition-all text-white bg-[#222222] peer-placeholder-shown:top-4 peer-placeholder-shown:left-4 peer-focus:-top-3 peer-focus:left-4 -top-3 left-4">Email</label></div><div class="relative"><input autocomplete="off" class="peer p-4 placeholder-transparent outline-none text-white w-[390px] h-[55px] border-[#ffffff] border rounded-xl bg-transparent" id="password" name="password" type="password" placeholder=" " /><label for="password" class="absolute pl-1 pr-1 transition-all text-white bg-[#222222] peer-placeholder-shown:top-4 peer-placeholder-shown:left-4 peer-focus:-top-3 peer-focus:left-4 -top-3 left-4">Password</label></div></div><div class="flex justify-around items-center mt-6"><button type="submit" name="add" class="w-[80px] h-[35px] bg-green-700 border-green-800 border-2 rounded-md">Add</button><button type="button" onclick="closeModal()" class="w-[80px] h-[35px] bg-gray-700 border-gray-800 border-2 rounded-md">Cancel</button></div></form>`;document.getElementById("section").style.filter="blur(4px)";document.getElementById("section").style.pointerEvents="none";document.body.appendChild(modal)}function closeModal(){document.getElementById("section").style.filter="";document.getElementById("section").style.pointerEvents="";const modal=document.querySelector('.ADD_MODAL');modal&&modal.remove()}
