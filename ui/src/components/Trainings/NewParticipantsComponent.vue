<template>
    <div class="new-participants-component">
        <div class="new-participant-holder">
            <model-select :options="usersOptions" @input="addParticipant" placeholder="Participants"></model-select>
        </div>
        <div class="new-participants-list">
            <div v-for="(p, i) in participants"  v-bind:key="i" class="new-participant-item">
                <div class="new-participant-name"> {{ getUserName(p.participant_id) }}</div>
                <div class="new-participant-dates row">
                    <b-form-input type="date" v-model="participants[i].start_date" placeholder="From"
                                  :state="showError && errors[i].start ? false : null" class="col-5">

                    </b-form-input>
                    <b-form-input type="date" v-model="participants[i].end_date" class="col-5"
                                  :state="showError && errors[i].end ? false : null">

                    </b-form-input>
                    <div class="new-participant-buttons col-2">
                        <b-btn @click="deleteParticipant(i)" class="delete-button" variant="outline-danger">
                            <v-icon name="trash" />
                        </b-btn>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { ModelSelect } from 'vue-search-select'
export default{
  components: {
    ModelSelect
  },
  props: {
    showError: {
      type: Boolean,
      default: false
    },
    participantsInitial: {
      type: Array,
      default () {
        return []
      }
    },
    options: {
      type: Array,
      default () {
        return null
      }
    }
  },
  data () {
    return {
      participants: []
    }
  },
  mounted () {
    this.participants = this.participantsInitial
  },
  watch: {
    participants (val) {
      this.$emit('input', val)
    },
    errors (val) {
      this.$emit('error', val.some(x => Object.values(x).some(y => y)))
    },
    participantsInitial (val) {
      this.participants = val
    }
  },
  computed: {
    usersOptions () {
      if (this.options) {
        return this.options
      } else {
        return this.$store.getters.usersOptions.filter(x => x.value !== this.$store.state.userID &&
          !this.participants.some(p => p.participant_id === x.value))
      }
    },
    errors () {
      return this.participants.map(p => {
        return {
          start: !p.start_date,
          end: !p.end_date || p.start_date >= p.end_date
        }
      })
    }
  },
  methods: {
    addParticipant (id) {
      this.participants.push({
        participant_id: id,
        start_date: null,
        end_date: null
      })
    },
    deleteParticipant (index) {
      this.participants.splice(index, 1)
    },
    getUserName (id) {
      return this.$store.state.users.find(x => x.ID === id).NAME
    }
  }
}
</script>
<style>
.new-participant-buttons{
    text-align: right;
}
.new-participant-item{
    margin: .5rem auto;
    text-align: left;
}
</style>
