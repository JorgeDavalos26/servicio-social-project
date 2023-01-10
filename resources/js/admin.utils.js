window.isPositiveInteger = function isPositiveInteger(str) {
    try {
        if (typeof str !== "string") {
            return false;
        }
        const num = Number(str);
        if (Number.isInteger(num) && num > 0) {
            return true;
        }
        return false;
    } catch (error) {
        console.log(error);
        return false;
    }
};

window.parseDatepickerDate = function parseDatepickerDate(string) {
    const splitString = string.split(/\D/);
    return splitString.reverse().join("-");
};

window.capitalizeFirstLetter = function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
};

window.formatSetting = function formatSetting(string) {
    return string.split(".")[1].replace("_", " ").toLowerCase();
};
window.convertWordsToAccentWords = function convertWordsToAccentWords(string) {
    const str = string.split(" ");
    const words = {
        tecnologo: "tecnólogo",
        ingenieria: "ingeniería",
        nivelacion: "nivelación",
        propedeutico: "propedéutico",
    };
    return str
        .map((word) => {
            if (words[word]) return words[word];
            return word;
        })
        .join(",")
        .replace(",", " ");
};
