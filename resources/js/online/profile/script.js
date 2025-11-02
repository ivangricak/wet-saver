





export function CheckOnFollow() {
    const followBtn = document.getElementById('follow-btn');
    if(!followBtn) return;
    const userId = document.getElementById('follow-block').dataset.userId;
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    followBtn.addEventListener('click', async function () {
        if(this.textContent.trim() === 'follow') {

            const res = await fetch(`follow/${userId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            });
            if(res.ok) {
                this.textContent = 'Unfollow';
                this.classList.remove('btn-primary');
                this.classList.add('btn-danger');
            } else {
                console.error('Follow failed');
            }
        } else {
            const res = await fetch(`follow/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            });
            if(res.ok) {
                this.textContent = 'follow';
                this.classList.remove('btn-danger');
                this.classList.add('btn-primary');
            } else {
                console.error('Unfollow failed');
            }
        }
    });
}