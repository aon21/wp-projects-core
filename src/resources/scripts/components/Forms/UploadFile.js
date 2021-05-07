export const UploadFile = () => {
    const actualBtn = document.getElementById('uplButton');
    const fileChosen = document.getElementById('file-chosen');

    const set = () => {
        fileChosen.textContent = actualBtn.files[0].name;
    }

    const init = () => {
        actualBtn.addEventListener('change', set)
    };

    return { init };
};
