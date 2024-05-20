//Trigger template actor
// actor_id = {int} 1
// language_id = {int} 2
// name = "Renter"
// updated_by = {int} 1
// deleted_by = null
// created_at = "2018-07-23 15:10:05"
// updated_at = "2018-07-23 15:10:05"
// deleted_at = null
// id = {int} 1
export interface Actor {
    id: number;
    name: string;
    slug: string;
    state: string;
    created_by: number;
    updated_by: number;
}
