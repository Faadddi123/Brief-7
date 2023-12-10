document.addEventListener("DOMContentLoaded", function () {
    const addButton = document.getElementById("plusButton");
    const container = document.getElementById("formContainer");
    let number = 0;

    addButton.addEventListener("click", function () {
        // Hide the button
        addButton.style.display = "none";

        const newForm = document.createElement("article");
        newForm.className =
            "rounded-xl mt-10  bg-white p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300";

        // Fetch options dynamically from PHP
        fetchOptions().then((options) => {
            newForm.innerHTML = `
        <a>
          <form  method="post" enctype="multipart/form-data">
            <div class="relative flex items-end overflow-hidden rounded-xl">
              <input type="file" name="imageToUpload">
            </div>

            <div class="mt-10 p-2">
              <div class="flex">
                <input class="text-slate-700" placeholder="${++number}" name="name">
                <select id="roleSelect" value="1" name="role">
                  ${options.map(option => `<option value="${option.name}">${option.name}</option>`).join('')}
                </select>
              </div>
              <div class="mt-1 text-sm text-slate-400 flex">
                <input type="text" placeholder="city" name="city">
                <input type="text" placeholder="country" name="country">
              </div>

              <div class="mt-3 flex items-end justify-between">
                <input class="text-lg font-bold text-blue-500 to-blue-500" placeholder="price" name="new_price">
                <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-3 py-1.5 text-white duration-100 hover:bg-blue-600">
                  <button type="submit" name="submit" value="Submit" class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                    <a  class="text-sm">submit</a>
                  </button>
                </div>
              </div>
            </div>
          </form> 
        </a>
      `;
            container.appendChild(newForm);

            // Show the button again
            addButton.style.display = "block";
        });
    });

    // Function to fetch options from PHP
    async function fetchOptions() {
        const response = await fetch('get_options.php'); // Replace with the actual path
        const data = await response.json();
        return data;
    }
});
