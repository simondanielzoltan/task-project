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
                  <tr
                    data-bs-toggle="collapse"
                    :href="'#collapseTask' + task.id"
                    class="pointer"
                  >
                    <th scope="row">{{ task.id }}</th>
                    <td>{{ task.name }}</td>
                    <td>{{ formatStatus(task.priority) }}</td>
                    <td>{{ formatStatus(task.state) }}</td>
                    <td>{{ task.created_by.name ?? "" }}</td>
                    <td>{{ task.deadline_at }}</td>
                    <td>
                      <button type="button" class="btn btn-primary">
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
  </div>
</template>

<script>
export default {
  name: "dashboard",
  data() {
    return {
      tasks: [],
    };
  },
  created() {
    axios.get("/api/task").then(({ data }) => {
      this.tasks = data.data;
    });
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
  },
};
</script>
<style scoped>
.pointer {
  cursor: pointer;
}
</style>