export default function () {
    const modal = false;
    const loading = true;

    const asyncOK = () => {
        setTimeout(() => {
            modal = false;
        }, 2000);
    }

    return { modal, loading, asyncOK }
}