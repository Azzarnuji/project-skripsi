const GetValueProfile = () => {
    if (Cookies.get('profile') != undefined || Cookies.get('profile') != null) {
        return JSON.parse(Cookies.get('profile'));
    }
}

export default GetValueProfile;
