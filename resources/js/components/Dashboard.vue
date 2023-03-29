<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header">
            <h3>Tasks</h3>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Task Name</th>
                  <th scope="col">Priority</th>
                  <th scope="col">State</th>
                  <th scope="col">Created By</th>
                  <th scope="col">Deadline</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <template v-for="task in tasks" :key="task.id">
                  <tr>
                    <th scope="row">{{ task.id }}</th>
                    <td
                      data-bs-toggle="collapse"
                      :href="'#collapseTask' + task.id"
                      class="pointer"
                    >
                      {{ task.name }}
                    </td>
                    <td>{{ formatStatus(task.priority) }}</td>
                    <td>{{ formatStatus(task.state) }}</td>
                    <td>{{ task.created_by.name ?? "" }}</td>
                    <td>{{ task.deadline_at }}</td>
                    <td>
                      <button
                        type="button"
                        class="btn btn-primary"
                        @click="addUserModal(task)"
                        data-bs-toggle="modal"
                        data-bs-target="#addUserModal"
                      >
                        Add User
                      </button>
                    </td>
                  </tr>
                  <tr class="collapse" :id="'collapseTask' + task.id">
                    <td colspan="7">
                      <div class="collapse" :id="'collapseTask' + task.id">
                        <div class="container text-center">
                          <h4 class="row">Description:</h4>
                          <div class="row">
                            {{ task.description }}
                          </div>
                          <h4 class="row">Assigned:</h4>

                          <div
                            v-for="user in task.assigned_users"
                            :key="user.id"
                            class="row"
                          >
                            {{ user.name }}
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                </template>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="addUserModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <input type="text" v-model="search" @input="searchUser" />
            <select v-model="selectedUser">
              <option
                v-for="option in options"
                :value="option.id"
                :key="option.id"
              >
                {{ option.name }}
              </option>
            </select>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button
              type="button"
              class="btn btn-primary"
              :disabled="selectedUser === null"
              @click="assigneeUser"
              data-bs-dismiss="modal"
            >
              Save changes
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "dashboard",
  data() {
    return {
      tasks: [],
      options: [],
      selectedUser: null,
      selectedTask: null,
      search: "",
    };
  },
  created() {
    this.getTasks();
  },
  methods: {
    formatStatus(status) {
      return status.name.toLowerCase().replaceAll("_", " ") ?? "";
    },
    getTasks() {
      axios
        .get("/api/task")
        .then(({ data }) => {
          this.tasks = data.data;
        })
        .catch(({ response }) => {
          console.error(response);
        });
    },
    searchUser() {
      axios
        .get("/api/user/search/" + this.search)
        .then(({ data }) => {
          this.options = data.data;
          this.selectedUser = null;
          if (this.options.length === 1) {
            this.selectedUser = this.options[0].id;
          }
        })
        .catch(({ response }) => {
          console.error(response);
        });
    },
    addUserModal(task) {
      this.selectedTask = task;
      this.selectedUser = null;
      this.search = "";
    },
    assigneeUser() {
      axios
        .post(
          "/api/task/" + this.selectedTask.id + "/user/" + this.selectedUser
        )
        .then(({ data }) => {
          this.getTasks();
        })
        .catch(({ response }) => {
          console.error(response);
        });
    },
  },
};
</script>
<style scoped>
.pointer {
  cursor: pointer;
}
.pointer:hover {
  text-decoration: underline;
}
</style>