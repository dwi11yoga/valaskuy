// sembunyikan konten
function hideContent(params) {
    // params.classList.remove('');
    params.classList.add("hidden");
}
// menampilkan konten
function showContent(params) {
    params.classList.remove("hidden");
    // params.classList.add('hidden');
}

// simpan cookie
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime + (days * 24 + 60 + 60 + 1000));
        expires = `; expires=${date.toUTCString()}`;
    }

    document.cookie = `${name}=${value}` + expires + "; path=/";
}

// ambil cookie
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == " ") c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// atur mode darkmode
function darkmodeToggle(htmlId) {
    // dapatkan cookie
    let darkModeCookie = getCookie("darkmode");

    if (darkModeCookie == "false") {
        // jika darkmode bernilai false, maka ganti jadi true
        htmlId.classList.add("dark");
        setCookie("darkmode", true, 365);
        // desktop
        document.getElementById("darkmodeOn").classList.add("hidden"); // icon bulan
        document.getElementById("darkmodeOn").classList.remove("inline"); // icon bulan
        document.getElementById("darkmodeOff").classList.remove("hidden"); //icon matahari
        document.getElementById("darkmodeOff").classList.add("inline"); //icon matahari
        // mobile
        document.getElementById("darkmodeMobileOn").classList.add("hidden");
        document.getElementById("darkmodeMobileOff").classList.remove("hidden");
    } else {
        // selain itu false
        htmlId.classList.remove("dark");
        setCookie("darkmode", false, 365);
        // desktop
        document.getElementById("darkmodeOn").classList.remove("hidden"); // icon bulan
        document.getElementById("darkmodeOn").classList.add("inline"); // icon bulan
        document.getElementById("darkmodeOff").classList.add("hidden"); //icon matahari
        document.getElementById("darkmodeOff").classList.remove("inline"); //icon matahari
        // mobile
        document.getElementById("darkmodeMobileOn").classList.remove("hidden");
        document.getElementById("darkmodeMobileOff").classList.add("hidden");
    }
}

// cek apakah mode darkmode aktif
function darkmodeCheck() {
    const htmlId = document.getElementById("html");
    let darkModeCookie = getCookie("darkmode");
    if (darkModeCookie == "true") {
        // jika darkmode bernilai true
        htmlId.classList.add("dark");
        document.getElementById("darkmodeOn").classList.add("hidden"); // icon bulan
        document.getElementById("darkmodeOn").classList.remove("inline"); // icon bulan
        document.getElementById("darkmodeOff").classList.remove("hidden"); //icon matahari
        document.getElementById("darkmodeOff").classList.add("inline"); //icon matahari
        // mobile
        document.getElementById("darkmodeMobileOn").classList.add("hidden");
        document.getElementById("darkmodeMobileOff").classList.remove("hidden");
    } else {
        // selain itu false
        htmlId.classList.remove("dark");
        // desktop
        document.getElementById("darkmodeOn").classList.remove("hidden"); // icon bulan
        document.getElementById("darkmodeOn").classList.add("inline"); // icon bulan
        document.getElementById("darkmodeOff").classList.add("hidden"); //icon matahari
        document.getElementById("darkmodeOff").classList.remove("inline"); //icon matahari
        // mobile
        document.getElementById("darkmodeMobileOn").classList.remove("hidden");
        document.getElementById("darkmodeMobileOff").classList.add("hidden");
    }
}
